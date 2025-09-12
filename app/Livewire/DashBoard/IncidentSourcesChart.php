<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Incident;

class IncidentSourcesChart extends Component
{
    public $chartData;

    public function mount()
    {
        $this->chartData = $this->getChartData();
    }

    public function getChartData()
    {
        $data = \App\Models\Incident::with('source')
            ->get()
            ->groupBy(fn($incident) => $incident->source->name ?? 'غير معروف')
            ->map(fn($group) => $group->count());

        return [
            'labels' => $data->keys()->toArray(),
            'series' => $data->values()->toArray(),
        ];
    }

    public function render()
    {
        return view('livewire.dashboard.incident-sources-chart');
    }
}
