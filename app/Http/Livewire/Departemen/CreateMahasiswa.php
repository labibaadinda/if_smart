<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class CreateMahasiswa extends Component
{
    public $name, $test;

    public function updatedTest($value)
    {
        // Update the 'test' property with the new value
        $this->test = $value;
    }

    public function render()
    {
        $data = 'masuk';

        return view('livewire.admin.create-mahasiswa', [
            'data' => $data,
            'test' => $this->test,
            'nama' => $this->name,
        ]);
    }
}