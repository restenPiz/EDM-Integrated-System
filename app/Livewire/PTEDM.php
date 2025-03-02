<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use function usleep;

class PTEDM extends Component
{
    //*Defining the attributes what im using here in this object
    public $pts = [];
    public $city, $pt, $name, $neighborhood, $deleteId, $id;
    //*Edit PT attributes
    public $edit_id, $edit_name, $edit_city, $edit_neighborhood;

    //*This dispatch is created to hide the alerts when the conditions returns some session
    public function mount()
    {
        $this->fetchPts();
    }
    public function render()
    {
        return view('livewire.p-t-e-d-m');
    }
    public function fetchPts()
    {
        $response = Http::get(env('API_URL') . '/pts');

        if ($response->successful()) {
            $this->pts = $response->json()['pts'] ?? [];
        }
    }
    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'neighborhood' => 'required|string|max:255',
        ]);

        $response = Http::post(env('API_URL') . '/storePts', [
            'name' => $this->name,
            'city' => $this->city,
            'neighborhood' => $this->neighborhood,
        ]);

        if ($response->successful()) {
            session()->flash('success', 'PT-EDM added with success!');
            $this->reset(['name', 'city', 'neighborhood']);
            $this->dispatch('hide-alerts');
            $this->fetchPts();
        } else {
            session()->flash('error', 'Failed to add PT-EDM!');
            $this->dispatch('hide-alerts');
        }
    }
    public function update($id)
    {
        $this->validate([
            'edit_name' => 'required|string|max:255|',
            'edit_city' => 'required|string|max:255',
            'edit_neighborhood' => 'required|string|max:255',
        ]);

        $response = Http::post(env('API_URL') . "/updatePts/{$id}", [
            'name' => $this->edit_name,
            'city' => $this->edit_city,
            'neighborhood' => $this->edit_neighborhood,
        ]);

        if ($response->successful()) {
            session()->flash('success', 'PT-EDM updated with success!');
            $this->reset(['edit_id', 'edit_name', 'edit_city', 'edit_neighborhood']);
            $this->dispatch('hide-alerts');
            $this->dispatch('close-edit-modal');
            $this->fetchPts();
        } else {
            session()->flash('error', 'Failed to update PT-EDM!');
            $this->dispatch('close-edit-modal');
            $this->dispatch('hide-alerts');
        }
    }
    public function edit($id)
    {
        $pt = collect($this->pts)->where('id', $id)->first();

        if ($pt) {
            $this->edit_id = $pt['id'];
            $this->edit_name = $pt['name'];
            $this->edit_city = $pt['city'];
            $this->edit_neighborhood = $pt['neighborhood'];

            // usleep(200000); // 200ms 

            $this->dispatch('show-edit-modal');
        }
    }
    public function delete($id)
    {
        $response = Http::post(env('API_URL') . "/deletePts/{$id}");

        if ($response->successful()) {
            session()->flash('success', 'PT-EDM deleted successfully!');
            $this->dispatch('hide-alerts');
            $this->fetchPts();
        } else {
            session()->flash('error', 'Failed to delete PT-EDM!');
            $this->dispatch('hide-alerts');
        }
    }
}
