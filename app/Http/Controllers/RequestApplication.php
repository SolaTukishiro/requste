<?php

namespace App\Http\Controllers;

use App\Models\Request as RequestModel;
use App\Models\RequestApplication as RequestApplicationModel;
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

    public function requestsApplicationStore(RequestModel $request, Request $httpRequest){
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
}
