<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'client_id',
        'title',
        'status',
        'description',
        'price',
    ];

    public function client(){
        return $this->belongsTo(User::class, 'client_id');
    }

    public function applications(){
        return $this->hasMany(RequestApplication::class, 'request_id');
    }
}
