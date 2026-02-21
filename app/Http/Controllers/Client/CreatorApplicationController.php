<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\ApplicationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CreatorApplicationController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'open');

        $query = Application::query()->with('creator');

        if ($tab === 'open') {
            $query->where('status', true);
        } elseif ($tab === 'closed') {
            $query->where('status', false);
        } elseif ($tab === 'all') {
            // フィルターなし
        } else {
            $tab = 'open';
            $query->where('status', true);
        }

        $applications = $query
            ->latest()
            ->paginate(12)
            ->appends(['tab' => $tab]);

        return view('client.creator-applications.index', compact('applications', 'tab'));
    }

    public function detail(Application $application)
    {
        $application->load('creator');

        $isRequested = ApplicationRequest::where('application_id', $application->id)
            ->where('client_id', auth()->id())
            ->exists();

        return view('client.creator-applications.detail', compact('application', 'isRequested'));
    }

    public function apply(Application $application)
    {
        $application->load('creator');

        return view('client.creator-applications.apply', compact('application'));
    }

    public function store(Application $application, Request $request): RedirectResponse
    {
        if (!$application->status) {
            return redirect()->back()->with('error', '募集が終了した案件には依頼できません');
        }

        $existing = ApplicationRequest::where('application_id', $application->id)
            ->where('client_id', auth()->id())
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'この案件には既に依頼済みです');
        }

        $request->validate([
            'message' => 'required',
            'proposed_price' => 'required|integer|min:0',
            'delivery_estimate' => 'required|integer|min:1',
        ]);

        ApplicationRequest::create([
            'application_id' => $application->id,
            'client_id' => auth()->id(),
            'message' => $request->message,
            'proposed_price' => $request->proposed_price,
            'delivery_estimate' => $request->delivery_estimate,
        ]);

        return redirect()->route('client.creator-applications.index')->with('success', '案件に依頼しました');
    }

    public function myRequests(Request $request)
    {
        $tab = $request->query('tab', 'pending');

        $query = ApplicationRequest::where('client_id', auth()->id())
            ->with(['application' => fn($q) => $q->withTrashed()->with('creator')]);

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

        return view('client.creator-applications.my-requests', compact('applicationRequests', 'tab'));
    }

    public function myRequestDetail(ApplicationRequest $applicationRequest)
    {
        if ($applicationRequest->client_id !== auth()->id()) {
            abort(403);
        }

        $applicationRequest->load(['application' => fn($q) => $q->withTrashed()->with('creator')]);

        if (!$applicationRequest->application) {
            abort(404);
        }

        return view('client.creator-applications.my-request-detail', compact('applicationRequest'));
    }

    public function destroyRequest(ApplicationRequest $applicationRequest): RedirectResponse
    {
        if ($applicationRequest->client_id !== auth()->id()) {
            abort(403);
        }

        if ($applicationRequest->status?->value !== 'pending') {
            return redirect()->back()->with('error', '選考が終了した依頼は取り下げできません');
        }

        $applicationRequest->delete();

        return redirect()->route('client.creator-applications.my-requests')->with('success', '依頼を取り下げました');
    }
}
