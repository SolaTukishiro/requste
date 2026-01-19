<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        'request_application_id',
        'request_id',
        'client_id',
        'creator_id'
    ];

    public function application()
    {
        return $this->belongsTo(RequestApplication::class, 'request_application_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
