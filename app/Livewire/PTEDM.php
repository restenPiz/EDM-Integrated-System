<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class PTEDM extends Component
{
    public $pts = [];
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
    public function render()
    {
        return view('livewire.p-t-e-d-m');
    }
}
