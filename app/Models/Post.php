<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    // Si quieres, agregas relación local (no forzada)
    // public function user()
    // {
    //     return $this->belongsTo(\App\Models\User::class, 'user_id'); 
    // }
}
