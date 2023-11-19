<?php

namespace App\Models;

use App\Models\Parameter;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;

class Analisa extends Model
{
    protected $fillable = ['name', 'harga', 'image', 'status'];

    public function parameters()
    {
        return $this->belongsToMany(Parameter::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'analisa_id');
    }
}
