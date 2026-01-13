<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApplicationController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $applications = Application::where('creator_id', auth()->id())->get();
        return view('creator.applications.index', compact('applications'));
    }

    public function create()
    {
        return view('creator.applications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        Application::create([
            'creator_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'price' => $request->price,
        ]);

        return redirect()->route('creator.applications.index');
    }

    public function detail(Application $recruitment)
    {
        $this->authorize('update', $recruitment);

        return view('creator.applications.detail', compact('recruitment'));
    }

    public function edit(Application $recruitment)
    {
        $this->authorize('update', $recruitment);

        return view('creator.applications.edit', compact('recruitment'));
    }

    public function update(Application $recruitment, Request $request)
    {
        $this->authorize('update', $recruitment);

        $recruitment->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'price' => $request->price,
        ]);

        return redirect()->route('creator.applications.index');
    }
}
