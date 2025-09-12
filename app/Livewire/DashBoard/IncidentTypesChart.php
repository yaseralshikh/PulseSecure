<?php

namespace App\Livewire\Dashboard;

use App\Models\Incident;
use Livewire\Component;

class IncidentTypesChart extends Component
{
    public $incidentTypesData;

    public function mount()
    {
        $this->incidentTypesData = $this->getIncidentTypesChart();
    }

    public function getIncidentTypesChart()
    {
        $data = Incident::selectRaw('incident_type_id, COUNT(*) as count')
            ->groupBy('incident_type_id')
            ->with('type') // eager load
            ->get()
            ->map(function ($item) {
                return [
                    'label' => $item->type->name ?? 'غير معروف',
                    'count' => $item->count,
                ];
            });

        return [
            'labels' => $data->pluck('label'),
            'series' => $data->pluck('count'),
        ];
    }

    public function render()
    {
        return view('livewire.dashboard.incident-types-chart');
    }
}
