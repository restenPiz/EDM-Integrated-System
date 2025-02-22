<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class PTEDM extends Component
{
    public $pts = [];
    public $city, $name, $neighborhood;
    public function mount()
    {
        $this->fetchPts();
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
        $response = Http::post(env('API_URL') . '/storePts', [
            'name' => $this->name,
            'city' => $this->city,
            'neighborhood' => $this->neighborhood,
        ]);

        if ($response->successful()) {
            session()->flash('success', 'PT-EDM adicionado com sucesso!');
            $this->reset(['name', 'city', 'neighborhood']);
        } else {
            session()->flash('error', 'Erro ao adicionar PT-EDM!');
        }
    }

    public function render()
    {
        return view('livewire.p-t-e-d-m');
    }
}
