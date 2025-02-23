<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'date',
        'start_time',
        'end_time',
        'number_of_people',
        'total_price',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function horses()
    {
        return $this->belongsToMany(Horse::class, 'reservation_horses');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}

