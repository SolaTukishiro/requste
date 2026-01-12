<?php

namespace App\Policies;

use App\Models\Application;
use App\Models\User;

class ApplicationPolicy
{
    public function update(User $user, Application $recruitment): bool
    {
        return $recruitment->creator_id === $user->id;
    }
}
