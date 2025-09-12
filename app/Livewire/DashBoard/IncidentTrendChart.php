<?php

namespace App\Livewire\DashBoard;

use Livewire\Component;
use App\Models\Incident;
use Illuminate\Support\Carbon;

class IncidentTrendChart extends Component
{
    public $chartData;
    public $incidentTypesData;

    public function mount()
    {
        $this->chartData = $this->getChartData();
        $this->incidentTypesData = $this->getIncidentTypesChart();
    }

    public function getChartData()
    {
        // Group by date
        $incidents = Incident::selectRaw('DATE(date) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'labels' => $incidents->pluck('date')->toArray(),
            'series' => [[
                'name' => 'عدد الوقوعات',
                'data' => $incidents->pluck('count')->toArray(),
            ]]
        ];

        // Group by month and year
        // $incidents = Incident::selectRaw("DATE_FORMAT(date, '%Y-%m') as month, COUNT(*) as count")
        //     ->groupBy('month')
        //     ->orderBy('month')
        //     ->get();

        // return [
        //     'labels' => $incidents->pluck('month')->toArray(),
        //     'series' => [[
        //         'name' => 'عدد الوقوعات',
        //         'data' => $incidents->pluck('count')->toArray(),
        //     ]]
        // ];        
    }

    public function getIncidentTypesChart()
    {
        $data = \App\Models\Incident::selectRaw('incident_type_id, COUNT(*) as count')
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
        return view('livewire.dash-board.incident-trend-chart');
    }
}
