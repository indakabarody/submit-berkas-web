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
        'foreword',
        'references',
        'file',
        'reviewed_at',
        'done_reviewed_at',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
