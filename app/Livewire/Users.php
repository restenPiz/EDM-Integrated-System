<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Users extends Component
{
    public $name, $id, $file, $password, $email;
    public function render()
    {
        return view('livewire.users');
    }
    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'file' => 'required|file|mimes:jpg,png,pdf|max:2048',
            'password' => 'required|string|min:6|max:255',
            'email' => 'required|email|max:255',
        ]);

        $response = Http::attach('file', file_get_contents($this->file->getRealPath()), $this->file->getClientOriginalName())
            ->post(env('API_URL') . '/storeUsers', [
                'name' => $this->name,
                'password' => $this->password,
                'email' => $this->email,
            ]);

        if ($response->successful()) {
            session()->flash('success', 'User added with success!');
            $this->reset(['name', 'file', 'email', 'password']);
            $this->dispatch('hide-alerts');
            $this->fetchPts();
        } else {
            session()->flash('error', 'Failed to add User!');
            $this->dispatch('hide-alerts');
        }
    }
}
