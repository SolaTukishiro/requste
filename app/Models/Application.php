<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'creator_id',
        'title',
        'status',
        'description',
        'price',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}
