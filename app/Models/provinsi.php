<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class provinsi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nama',
    ];
    public function mahasiswa(){
        return $this->hasMany(Mahasiswa::class);
    }
    public function kota(){
        return $this->hasMany(Kota::class);
    }
}
