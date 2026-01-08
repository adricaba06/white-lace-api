<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeddingMember extends Model
{
    use HasFactory;

    protected $table = 'Wedding_Members';


    protected $fillable = [
    'wedding_id',
    'user_id',
    'role',
    'status',
    'profile_picture_url',
    ];


 
    public function wedding()
    {
        return $this->belongsTo(Wedding::class, 'wedding_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function tableAssignment()
    {
        return $this->hasOne(TableAssignment::class, 'wedding_member_id');
    }


    public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_to_user_id');
    }
}
