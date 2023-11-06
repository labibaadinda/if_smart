<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class CreateMahasiswa extends Component
{
    public $name, $test = '1';

    // protected $rules = [
    //     'name' => 'required|min:5|max:40',
    //     'alamat' => 'required|min:10',
    //     'phone' => 'required|min:10|numeric',
    //     'email' => 'required|email:rfc,dns|unique:users',
    //     'password' => 'required|min:6',
    //     'photo' => 'required|image',
    //     'asal_universitas' => 'required',
    //     'jurusan' => 'required',

    // ];

    public function render()
    {
        $data = 'masuk';
        return view('livewire.admin.create-mahasiswa',[
            'data' => $data,
            'test' => $this->test,
            'nama' => $this->name,
        ]);
    }
}
