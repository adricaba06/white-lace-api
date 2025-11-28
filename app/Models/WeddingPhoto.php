<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeddingPhoto extends Model
{
    use HasFactory;

    protected $table = 'Wedding_Photos';

    protected $fillable = [
        'wedding_id',
        'uploaded_by_user_id',
        'url',
        'caption',
    ];


    public function wedding()
    {
        return $this->belongsTo(Wedding::class, 'wedding_id');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by_user_id');
    }
}
