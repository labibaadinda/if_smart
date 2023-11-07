<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class provinsi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function mahasiswa(){
        return $this->hasMany(Mahasiswa::class);
    }
}
