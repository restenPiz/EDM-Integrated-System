<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;

class Users extends Component
{
    use WithFileUploads;
    public $name, $password, $email, $file, $users;

    public function mount()
    {
        $this->fetchUsers();
    }
    public function render()
    {
        return view('livewire.users');
    }
    public function fetchUsers()
    {
        $response = Http::get(env('API_URL') . '/users');

        if ($response->successful()) {
            $this->users = $response->json()['users'] ?? [];
        }
    }
    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'file' => 'file|mimes:jpg,png,pdf',
            'password' => 'required|string|min:6|max:255',
            'email' => 'required|email|max:255',
        ]);

        $response = Http::post(env('API_URL') . '/storeUsers', [
            'name' => $this->name,
            'password' => $this->password,
            'email' => $this->email,
            'file' => $this->file,
        ]);

        if ($response->successful()) {
            session()->flash('success', 'User added with success!');
            $this->reset(['name', 'email', 'file', 'password']);
            $this->dispatch('hide-alerts');
            $this->dispatch('close-add-modal');
            $this->fetchUsers();
        } else {
            session()->flash('error', 'Failed to add User!');
            $this->dispatch('hide-alerts');
            $this->dispatch('close-add-modal');
        }
    }
}
