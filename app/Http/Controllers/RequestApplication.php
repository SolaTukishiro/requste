<?php

namespace App\Http\Controllers;

use App\Models\Request as RequestModel;

class RequestApplication extends Controller
{
    public function requestsShow(){
        $requests = RequestModel::where('status',1)->get();
        return view('creator.requests.index', compact('requests'));
    }
}
