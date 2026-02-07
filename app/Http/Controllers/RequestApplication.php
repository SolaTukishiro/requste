<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Request as RequestModel;
use App\Models\RequestApplication as RequestApplicationModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class RequestApplication extends Controller
{
    use AuthorizesRequests;
    public function requestsShow(Request $request){
        // tab: open | closed | all
        $tab = $request->query('tab', 'open');

        $query = RequestModel::query()
            ->with('client')               // 一覧で client->name を使うため
            ->whereNull('deleted_at');     // SoftDeletes 使ってるなら本来不要。保険で書くならこれ。

        if ($tab === 'open') {
            $query->where('status', true);
        } elseif ($tab === 'closed') {
            $query->where('status', false);
        } elseif ($tab === 'all') {
            // 何もしない
        } else {
            // 変な値が来たらデフォルトに戻す
            $tab = 'open';
            $query->where('status', true);
        }

        $requests = $query
            ->latest()
            ->paginate(12)
            ->appends(['tab' => $tab]); // ページ送りでもタブ維持

        return view('creator.requests.index', compact('requests', 'tab'));
    }

    public function requestsDetail(RequestModel $request){
        $request->load('client');

        // ログイン中のクリエイターが既に応募済みかチェック
        $isApplied = RequestApplicationModel::where('request_id', $request->id)
            ->where('creator_id', auth()->id())
            ->exists();

        return view('creator.requests.detail', compact('request', 'isApplied'));
    }

    public function requestsApplication(RequestModel $request){
        $request->load('client');

        return view('creator.requests.application', compact('request'));
    }

    public function requestsApplicationStore(RequestModel $request, Request $httpRequest): RedirectResponse
    {
        // 既に応募済みかチェック
        $existingApplication = RequestApplicationModel::where('request_id', $request->id)
            ->where('creator_id', auth()->id())
            ->first();

        if ($existingApplication) {
            return redirect()->back()->with('error', 'この案件には既に応募済みです');
        }

        $httpRequest->validate([
            'message' => 'required',
            'proposed_price' => 'required',
            'delivery_estimate' => 'required'
        ]);

        RequestApplicationModel::create([
            'request_id' => $request->id,
            'creator_id' => auth()->id(),
            'message' => $httpRequest->message,
            'proposed_price' => $httpRequest->proposed_price,
            'delivery_estimate' => $httpRequest->delivery_estimate
        ]);


        return redirect()->route('creator.requests.show')->with('success', '案件に応募しました');
    }

    public function applicationsShow()
    {
        $applicationList = RequestApplicationModel::where('creator_id', auth()->id())
            ->with('request.client')
            ->latest()
            ->get();

        return view('creator.requests.applicationShow', compact('applicationList'));
    }

    public function applicationsShowDetail(RequestApplicationModel $application){
        // 自分の応募のみ閲覧可能
        if ($application->creator_id !== auth()->id()) {
            abort(403);
        }

        $application->load(['request.client', 'creator']);

        return view('creator.requests.applicationShowDetail', compact('application'));
    }

    public function applicationsDestroy(RequestApplicationModel $application): RedirectResponse
    {
        // 自分の応募のみ削除可能
        if ($application->creator_id !== auth()->id()) {
            abort(403);
        }

        // 選考中の場合のみ取り下げ可能
        if ($application->status?->value !== 'pending') {
            return redirect()->back()->with('error', '選考が終了した応募は取り下げできません');
        }

        $application->delete();

        return redirect()->route('creator.requests.applications.show')->with('success', '応募を取り下げました');
    }

    // ========== Client用メソッド ==========

    public function clientApplicationsIndex(RequestModel $request)
    {
        // 自分の依頼のみ閲覧可能
        if ($request->client_id !== auth()->id()) {
            abort(403);
        }

        $request->load(['applications.creator']);

        return view('client.requests.applications', compact('request'));
    }

    public function clientApplicationDetail(RequestModel $request, RequestApplicationModel $application)
    {
        // 自分の依頼のみ閲覧可能
        if ($request->client_id !== auth()->id()) {
            abort(403);
        }

        // 応募がこの依頼に属しているかチェック
        if ($application->request_id !== $request->id) {
            abort(404);
        }

        $application->load('creator');

        return view('client.requests.applicationDetail', compact('request', 'application'));
    }

    public function clientAllApplications(Request $httpRequest)
    {
        $tab = $httpRequest->query('tab', 'pending');

        // クライアントの全依頼に来た応募を取得（削除済み依頼も含む）
        $query = RequestApplicationModel::whereHas('request', function ($q) {
            $q->withTrashed()->where('client_id', auth()->id());
        })->with(['request' => fn($q) => $q->withTrashed(), 'creator']);

        if ($tab === 'pending') {
            $query->where('status', 'pending');
        } elseif ($tab === 'accepted') {
            $query->where('status', 'accepted');
        } elseif ($tab === 'rejected') {
            $query->where('status', 'rejected');
        } elseif ($tab === 'all') {
            // 何もしない
        } else {
            $tab = 'pending';
            $query->where('status', 'pending');
        }

        $applications = $query->latest()->paginate(12)->appends(['tab' => $tab]);

        return view('client.applications.index', compact('applications', 'tab'));
    }

    public function clientAllApplicationDetail(RequestApplicationModel $application)
    {
        // 削除済み依頼も含めてロード
        $application->load(['request' => fn($q) => $q->withTrashed(), 'creator']);

        // 依頼が存在しない場合は404
        if (!$application->request) {
            abort(404);
        }

        // 自分の依頼への応募のみ閲覧可能
        if ($application->request->client_id !== auth()->id()) {
            abort(403);
        }

        return view('client.applications.detail', compact('application'));
    }

    public function accept(RequestApplicationModel $application): RedirectResponse
    {
        $this->authorizeClientOwnership($application);

        if ($application->status->value !== 'pending') {
            return redirect()->back()->with('error', 'この応募は既に選考済みです');
        }

        $application->update(['status' => 'accepted']);

        // 採用時にConversationを自動作成（まだ存在しない場合のみ）
        Conversation::firstOrCreate(
            ['request_application_id' => $application->id],
            [
                'request_id' => $application->request_id,
                'client_id' => $application->request->client_id,
                'creator_id' => $application->creator_id,
            ]
        );

        return redirect()->back()->with('success', 'クリエイターを採用しました');
    }

    public function reject(RequestApplicationModel $application): RedirectResponse
    {
        $this->authorizeClientOwnership($application);

        if ($application->status->value !== 'pending') {
            return redirect()->back()->with('error', 'この応募は既に選考済みです');
        }

        $application->update(['status' => 'rejected']);

        return redirect()->back()->with('success', '応募を見送りました');
    }

    private function authorizeClientOwnership(RequestApplicationModel $application): void
    {
        $application->load(['request' => fn($q) => $q->withTrashed()]);

        if (!$application->request || $application->request->client_id !== auth()->id()) {
            abort(403);
        }
    }
}
