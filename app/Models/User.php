<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relaciones

    public function weddings()
    {
        return $this->belongsToMany(Wedding::class, 'Wedding_Members', 'user_id', 'wedding_id');
    }

    public function tasksCreated()
    {
        return $this->hasMany(Task::class, 'created_by_user_id');
    }

    public function tasksAssigned()
    {
        return $this->hasMany(Task::class, 'assigned_to_user_id');
    }

    public function weddingMembers()
    {
        return $this->hasMany(WeddingMember::class, 'user_id');
    }

    public function weddingPhotos()
    {
        return $this->hasMany(WeddingPhoto::class, 'uploaded_by_user_id');
    }
}
