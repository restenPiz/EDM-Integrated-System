<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class PTEDM extends Component
{
    public function render()
    {
        return view('livewire.p-t-e-d-m');
    }
    public function fetchOccurrences()
    {
        $response = Http::get(env('http://127.0.0.1:8000/api') . '/pts');

        if ($response->successful()) {
            $this->occurrences = $response->json();
        }
    }
}
