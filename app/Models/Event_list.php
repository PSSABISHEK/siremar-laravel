<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class event_list extends Model
{
    use HasFactory;
    protected $table = 'event_list';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'event_id', 'name', 'address', 'max_seats', 'time', 'date', 'discount_rate'
    ];
}
