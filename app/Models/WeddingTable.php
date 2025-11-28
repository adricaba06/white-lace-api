<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeddingTable extends Model
{
    use HasFactory;

    protected $table = 'Wedding_Tables';

    protected $fillable = [
        'wedding_id',
        'table_number',
        'table_name',
        'max_capacity',
    ];


    public function wedding()
    {
        return $this->belongsTo(Wedding::class, 'wedding_id');
    }

    public function assignments()
    {
        return $this->hasMany(TableAssignment::class, 'wedding_table_id');
    }
}
