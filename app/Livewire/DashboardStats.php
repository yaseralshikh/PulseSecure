<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Incident;
use App\Models\Arrest;

class DashboardStats extends Component
{
    public int $totalIncidents = 0;
    public int $totalCases = 0;
    public int $totalArrests = 0;

    public function mount()
    {

        $this->totalIncidents = Incident::count();
        $this->totalCases = Incident::where('is_case', true)->count();
        $this->totalArrests = Arrest::count();
    }

    public function render()
    {
        return view('livewire.dashboard-stats');
    }
}
