<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'max_working_hours',
        'work_hours',
        'status',
    ];

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class);
    }
}

