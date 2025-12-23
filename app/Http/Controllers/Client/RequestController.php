<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Request as RequestModel;

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
        ]);

        return redirect()->route('client.requests.index');
    }
}
