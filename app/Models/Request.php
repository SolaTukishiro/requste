<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = [
        'client_id',
        'title',
        'status',
        'description',
    ];

    public function client(){
        return $this->belongsTo(User::class, 'client_id');
    }
}
