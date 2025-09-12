<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Incident;
use App\Models\Governorate;

class GovernorateIncidentsChart extends Component
{
    public $chartData;

    public function mount()
    {
        $this->chartData = $this->getChartData();
    }

    public function getChartData()
    {
        $data = Incident::selectRaw('governorate_id, COUNT(*) as total')
            ->groupBy('governorate_id')
            ->with('governorate')
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->governorate->name,
                    'total' => $item->total,
                ];
            });

        return [
            'labels' => $data->pluck('name'),
            'series' => [
                [
                    'name' => 'عدد الوقائع',
                    'data' => $data->pluck('total'),
                ]
            ]
        ];
    }    

    // public function getChartData()
    // {
    //     $data = Incident::selectRaw('governorate_id, COUNT(*) as count')
    //         ->groupBy('governorate_id')
    //         ->pluck('count', 'governorate_id');

    //     $governorates = Governorate::whereIn('id', $data->keys())->pluck('name', 'id');

    //     return [
    //         'labels' => $governorates->values()->toArray(),
    //         'series' => $data->values()->toArray(),
    //     ];
    // }   

    public function render()
    {
        return view('livewire.dashboard.governorate-incidents-chart');
    }
}
