<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;

class Users extends Component
{
    use WithFileUploads;
    public $file;

    public $name, $password, $email, $users, $id;
    public $edit_id, $edit_name, $edit_password, $edit_email, $edit_file;

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
            $this->reset(['name', 'email', 'file', 'password']);
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
    public function edit($id)
    {
        $user = collect($this->users)->where('id', $id)->first();

        if ($user) {
            $this->edit_id = $user['id'];
            $this->edit_name = $user['name'];
            $this->edit_email = $user['email'];
            $this->edit_file = $user['file'];
            // usleep(200000); // 200ms 
            $this->dispatch('show-edit-modal');
        }
    }
    public function update()
    {
        $this->validate([
            'edit_name' => 'required|string|max:255',
            'edit_email' => 'required|email|max:255',
            'edit_password' => 'nullable|string|min:6|max:255',
        ]);

        // Monta os dados que serão enviados
        if ($this->edit_file) {
            $response = Http::attach(
                'file',
                file_get_contents($this->edit_file->getRealPath()),
                $this->edit_file->getClientOriginalName()
            )->post(
                    env('API_URL') . '/updateUsers/' . $this->edit_id,
                    [
                        'name' => $this->edit_name,
                        'password' => bcrypt($this->edit_password), // Garante que a senha será criptografada antes de salvar
                        'email' => $this->edit_email,
                    ]
                );
        } else {
            $response = Http::post(env('API_URL') . '/updateUsers/' . $this->edit_id, [
                'name' => $this->edit_name,
                'password' => bcrypt($this->edit_password),
                'email' => $this->edit_email,
            ]);
        }

        if ($response->successful()) {
            session()->flash('success', 'User updated successfully!');
            $this->reset(['edit_name', 'edit_email', 'edit_password', 'edit_file']);
            $this->dispatch('hide-alerts');
            $this->dispatch('close-edit-modal');
            $this->fetchUsers();
        } else {
            $this->reset(['edit_name', 'edit_email', 'edit_password', 'edit_file']);
            session()->flash('error', 'Failed to update User!');
            $this->dispatch('hide-alerts');
            $this->dispatch('close-edit-modal');
        }
    }
}
