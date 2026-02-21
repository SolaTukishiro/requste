<?php

namespace App\Models;

use App\Enums\ApplicationStatus;
use Illuminate\Database\Eloquent\Model;

class ApplicationRequest extends Model
{
    protected $fillable = [
        'application_id',
        'client_id',
        'message',
        'proposed_price',
        'delivery_estimate',
        'status',
    ];

    protected $casts = [
        'status' => ApplicationStatus::class,
    ];

    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
