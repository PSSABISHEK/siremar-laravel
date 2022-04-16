<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport_booking extends Model
{
    use HasFactory;

    protected $table = 'transport_bookings';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'transport_id',
        'type',
        'source',
        'destination',
        'date',
        'time'
    ];
}
