<?php

namespace App\Models;

use App\Models\Metode;
use App\Models\Analisa;
use App\Models\Reservation;
use App\Models\CategoryParameter;
use Illuminate\Database\Eloquent\Model;


class Parameter extends Model
{
    protected $fillable = ['name', 'category_parameter_id', 'metode_id', 'harga'];

    public function categoryParameter()
    {
        return $this->belongsTo(CategoryParameter::class, 'category_parameter_id');
    }

    public function metode()
    {
        return $this->belongsTo(Metode::class, 'metode_id');
    }

    public function analisas()
    {
        return $this->belongsToMany(Analisa::class);
    }

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'reservasi_parameter', 'parameter_id', 'reservations_id')
            ->withPivot('harga')
            ->withTimestamps();
    }
}
