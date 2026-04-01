<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'completed', 'priority', 'due_at', 'category'];

    protected $casts = [
        'due_at' => 'datetime',
        'completed' => 'boolean',
    ];
}
