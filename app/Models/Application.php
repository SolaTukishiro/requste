<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use SoftDeletes;
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
