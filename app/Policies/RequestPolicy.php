<?php

namespace App\Policies;

use App\Models\Request as RequestModel;
use App\Models\User;

class RequestPolicy
{
    public function authClientId(RequestModel $request): bool
    {
        $result = true;
        if($request->client_id === auth() -> id()){
            $result = false;
        }
        return $result;
    }
}
