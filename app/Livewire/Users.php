<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;

class Users extends Component
{
    use WithFileUploads;
    public $file;

    public $name, $password, $email, $users;
    public $edit_name, $edit_password, $edit_email;

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
            $users = $response->json()['users'] ?? [];

            foreach ($users as &$user) {
                if (!empty($user['file'])) {
                    $user['file'] = asset('storage/' . $user['file']);
                }
            }

            $this->users = $users;
        }
    }
    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|max:255',
            'email' => 'required|email|max:255',
        ]);

        if ($this->file) {
            $response = Http::attach(
                'file',
                file_get_contents($this->file->getRealPath()),
                $this->file->getClientOriginalName()
            )->post(env('API_URL') . '/storeUsers', [
                        'name' => $this->name,
                        'password' => bcrypt($this->password), // Garante que a senha será criptografada antes de salvar
                        'email' => $this->email,
                    ]
                );
        } else {
            $response = Http::post(env('API_URL') . '/storeUsers', [
                'name' => $this->name,
                'password' => bcrypt($this->password),
                'email' => $this->email,
            ]);
        }

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
    public function delete($id)
    {
        $response = Http::post(env('API_URL') . "/deleteUsers/{$id}");

        if ($response->successful()) {
            session()->flash('success', 'User deleted with success!');
            $this->dispatch('hide-alerts');
            $this->fetchUsers();
        } else {
            session()->flash('error', 'Failed to delete User!');
            $this->dispatch('hide-alerts');
        }
    }
}
