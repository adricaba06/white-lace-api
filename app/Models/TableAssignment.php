<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableAssignment extends Model
{
    use HasFactory;

    protected $table = 'Table_Assignments';

    protected $fillable = [
        'wedding_member_id',
        'wedding_table_id',
    ];


    public function member()
    {
        return $this->belongsTo(WeddingMember::class, 'wedding_member_id');
    }

    public function table()
    {
        return $this->belongsTo(WeddingTable::class, 'wedding_table_id');
    }
}
