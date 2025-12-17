<?php

namespace App\Enums;

enum UserRole: string{
    case CLIENT = 'client';
    case CREATOR = 'creator';
    case ADMIN = 'admin';
}
