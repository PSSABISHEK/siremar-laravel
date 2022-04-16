<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Move_out extends Model
{
    use HasFactory;

    protected $table = 'move_outs';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'comments',
        'is_approved',
        'date'
    ];
}
