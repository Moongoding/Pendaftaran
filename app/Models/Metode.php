<?php

namespace App\Models;

use App\Models\Parameter;
use Illuminate\Database\Eloquent\Model;

class Metode extends Model
{
    protected $fillable = ['name'];

    public function parameters()
    {
        return $this->hasMany(Parameter::class, 'metode_id');
    }


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($metode) {
            // Hapus semua parameter yang terkait dengan metode ini saat metode dihapus
            $metode->parameters()->delete();
        });
    }
}
