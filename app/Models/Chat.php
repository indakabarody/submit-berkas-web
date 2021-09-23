<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'member_id',
        'subject',
        'message',
        'is_from_member',
        'is_from_admin',
        'read_at',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
