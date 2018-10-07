<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    protected $fillable = ['title', 'completed', ];
    protected $casts = ['completed' => 'boolean', ];

}