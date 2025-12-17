<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Request;

class RequestController extends Controller
{
    public function index(){
        $requests = Request::where('client_id', auth()->id())->get();
        return view('client.requests.index', compact('requests'));
    }
}
