<?php

namespace App\Models;

use App\Models\User;
use App\Models\Analisa;
use App\Models\Parameter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function analisa()
    {
        return $this->belongsTo(Analisa::class, 'analisa_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Menambahkan 'user_id' sebagai kunci asing
    }



    public function parameters()
    {
        return $this->belongsToMany(Parameter::class, 'reservasi_parameter', 'reservations_id', 'parameter_id') // Sesuaikan dengan nama kolom yang benar
            ->withPivot('jumlah') // Menyertakan kolom jumlah dari tabel perantara
            ->withTimestamps();
    }
}
