<?php

namespace App\Models;

use App\Enums\ApplicationStatus;
use Illuminate\Database\Eloquent\Model;

class RequestApplication extends Model
{
    protected $fillable = [
        'request_id',
        'creator_id',
        'message',
        'status'
    ];

    protected $casts = [
        'status' => ApplicationStatus::class,
    ];

    public function request()
    {
        return $this->belongsTo(Request::class, 'request_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function conversation()
    {
        return $this->hasOne(Conversation::class, 'request_application_id');
    }
}
