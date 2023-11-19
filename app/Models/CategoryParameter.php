<?php

namespace App\Models;

use App\Models\Parameter;
use Illuminate\Database\Eloquent\Model;

class CategoryParameter extends Model
{
    protected $fillable = ['name'];

    public function parameters()
    {
        return $this->hasMany(Parameter::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {
            // Hapus semua parameter yang memiliki category ini saat category dihapus
            $category->parameters()->delete();
        });
    }
}
