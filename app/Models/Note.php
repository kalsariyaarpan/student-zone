<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Note.php
class Note extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'cover_image',
        'content',
        'status'
    ];
}
