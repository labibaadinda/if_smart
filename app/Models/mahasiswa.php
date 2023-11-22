<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mahasiswa extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function dosen(){
        return $this->belongsTo(Dosen::class);
    }
    public function provinsi(){
        return $this->belongsTo(Provinsi::class);
    }
    public function kota(){
        return $this->belongsTo(Kota::class);
    }
    public function pkl()
    {
        return $this->hasMany(Pkl::class, 'nim', 'nim');
    }
    public function irs(){
        return $this->hasMany(Irs::class);
    }
    public function khs(){
        return $this->hasMany(Khs::class);
    }
    // public function pkl(){
    //     return $this->hasMany(Pkl::class);
    // }
    public function skripsi(){
        return $this->hasMany(Skripsi::class);
    }
}
