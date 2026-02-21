<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Application;
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

        return view('client.creator-applications.detail', compact('application'));
    }
}
