<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wedding extends Model
{
    use HasFactory;

    protected $table = 'Weddings';

    protected $fillable = [
        'wedding_date',
        'venue_name',
        'venue_address',
        'budget',
        'dress_code',
        'dress_code_details',
        'are_kids_allowed',
    ];

    // Relaciones

    public function members()
    {
        return $this->hasMany(WeddingMember::class, 'wedding_id');
    }

    public function tables()
    {
        return $this->hasMany(WeddingTable::class, 'wedding_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'wedding_id');
    }

    public function photos()
    {
        return $this->hasMany(WeddingPhoto::class, 'wedding_id');
    }
}


