<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Script extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'title',
        'forewood',
        'references',
        'file_name',
        'reviewed_at',
        'done_reviewed_at',
    ];
}
