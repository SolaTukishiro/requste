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

    public function detail(Application $application)
    {
        $this->authorize('update', $application);

        return view('creator.applications.detail', compact('application'));
    }

    public function edit(Application $application)
    {
        $this->authorize('update', $application);

        return view('creator.applications.edit', compact('application'));
    }

    public function update(Application $application, Request $request)
    {
        $this->authorize('update', $application);

        $application->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'price' => $request->price,
        ]);

        return redirect()->route('creator.applications.index');
    }

    public function destroy($id){
        $request = Application::where('id', $id)->firstOrFail();
        $this->authorize('update', $request);
        $request->delete();

        return redirect()->route('creator.applications.index');
    }

    public function deletedIndex(){
        $applications = Application::onlyTrashed()->where('creator_id', auth()->id())->get();
        return view('creator.applications.delete.show', compact('applications'));
    }

    public function deletedDetail($id){
        $application = Application::onlyTrashed()->where('id', $id)->firstOrFail();
        $this->authorize('update', $application);

        return view('creator.applications.delete.detail', compact('application'));
    }

    public function restore($id){
        $application = Application::onlyTrashed()->where('id', $id)->firstOrFail();
        $this->authorize('update', $application);
        $application->restore();

        return redirect()->route('creator.applications.index');
    }
}
