<?php

namespace App\Policies;

use App\Models\Request as RequestModel;
use App\Models\User;

class RequestPolicy
{
    public function update(User $user, RequestModel $request): bool
    {
        // 自分が作った依頼ならOK
        return $request->client_id === $user->id;
    }
}
