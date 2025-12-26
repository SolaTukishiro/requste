<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Request as RequestModel;
use App\Policies\RequestPolicy;

class RequestController extends Controller
{
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
        // dd($request);
        $policy = new RequestPolicy();
        if($policy->authClientId($request)){
            abort(403);
        }
        return view('client.requests.detail', compact('request'));
    }

    public function edit(RequestModel $request){
        $policy = new RequestPolicy();
        if($policy->authClientId($request)){
            abort(403);
        }
        return view('client.requests.edit', compact('request'));
    }
    public function update(RequestModel $requestModel, Request $request){
        $requestModel->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'price' => $request->price,
        ]);

        return redirect()->route('client.requests.index');
    }
}
