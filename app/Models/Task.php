<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'Tasks';

    protected $fillable = [
        'wedding_id',
        'created_by_user_id',
        'assigned_to_user_id',
        'name',
        'description',
        'status',
        'priority',
        'due_date',
        'completed_at'
    ];

    // Relaciones

    public function wedding()
    {
        return $this->belongsTo(Wedding::class, 'wedding_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }
}
