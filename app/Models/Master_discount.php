<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master_discount extends Model
{
    use HasFactory;

    protected $table = 'master_discount';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'name', 'events_rate', 'ferrys_rate', 'flights_rate', 'clinics_rate', 'schools_rate', 'is_active'
    ];

}
