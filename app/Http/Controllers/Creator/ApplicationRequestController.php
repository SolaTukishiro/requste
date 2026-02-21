<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\ApplicationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ApplicationRequestController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'pending');

        $query = ApplicationRequest::whereHas('application', function ($q) {
            $q->where('creator_id', auth()->id());
        })->with(['application', 'client']);

        if ($tab === 'pending') {
            $query->where('status', 'pending');
        } elseif ($tab === 'accepted') {
            $query->where('status', 'accepted');
        } elseif ($tab === 'rejected') {
            $query->where('status', 'rejected');
        } elseif ($tab === 'all') {
            // フィルターなし
        } else {
            $tab = 'pending';
            $query->where('status', 'pending');
        }

        $applicationRequests = $query->latest()->paginate(12)->appends(['tab' => $tab]);

        return view('creator.application-requests.index', compact('applicationRequests', 'tab'));
    }

    public function detail(ApplicationRequest $applicationRequest)
    {
        $applicationRequest->load(['application', 'client']);

        if (!$applicationRequest->application || $applicationRequest->application->creator_id !== auth()->id()) {
            abort(403);
        }

        return view('creator.application-requests.detail', compact('applicationRequest'));
    }

    public function accept(ApplicationRequest $applicationRequest): RedirectResponse
    {
        $this->authorizeCreatorOwnership($applicationRequest);

        if ($applicationRequest->status->value !== 'pending') {
            return redirect()->back()->with('error', 'この依頼は既に選考済みです');
        }

        $applicationRequest->update(['status' => 'accepted']);

        return redirect()->back()->with('success', 'クライアントの依頼を承認しました');
    }

    public function reject(ApplicationRequest $applicationRequest): RedirectResponse
    {
        $this->authorizeCreatorOwnership($applicationRequest);

        if ($applicationRequest->status->value !== 'pending') {
            return redirect()->back()->with('error', 'この依頼は既に選考済みです');
        }

        $applicationRequest->update(['status' => 'rejected']);

        return redirect()->back()->with('success', '依頼を見送りました');
    }

    private function authorizeCreatorOwnership(ApplicationRequest $applicationRequest): void
    {
        $applicationRequest->load('application');

        if (!$applicationRequest->application || $applicationRequest->application->creator_id !== auth()->id()) {
            abort(403);
        }
    }
}
