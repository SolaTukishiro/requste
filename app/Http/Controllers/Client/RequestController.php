<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Models\Request as RequestModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class RequestController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(){
        $requests = RequestModel::where('client_id', auth()->id())->get();
        return view('client.requests.index', compact('requests'));
    }

    public function create(){
        return view('client.requests.create');
    }

    public function store(Request $request){
        $request->validate(
            [
                'title' => 'required',
                'description' => 'required',
                'status' => 'required'
            ]
        );

        RequestModel::create([
            'client_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'price' => $request->price,
        ]);

        return redirect()->route('client.requests.index');
    }

    public function detail(RequestModel $request){
        $this->authorize('update', $request);

        return view('client.requests.detail', compact('request'));
    }

    public function edit(RequestModel $request){
        $this->authorize('update', $request);

        return view('client.requests.edit', compact('request'));
    }
    public function update(RequestModel $requestModel, Request $request){
        $this->authorize('update', $requestModel);

        $requestModel->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'price' => $request->price,
        ]);

        return redirect()->route('client.requests.index');
    }
}
