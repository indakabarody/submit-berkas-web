<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'title',
        'content',
        'read_at',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
