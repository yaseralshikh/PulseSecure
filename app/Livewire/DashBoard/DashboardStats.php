<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Incident;
use App\Models\Arrest;
use App\Models\Governorate;
use App\Models\Incident_type;
use App\Models\Incident_source;

class DashboardStats extends Component
{
    public int $totalIncidents = 0;
    public int $totalCases = 0;
    public int $totalArrests = 0;

    public $filterType = '';
    public $startDate;
    public $endDate;
    public $incidentTypes;

    // بيانات جميع الرسوم البيانية
    public $trendChartData;
    public $typePieData;
    public $sourcePieData;
    public $governorateBarData;

    protected $listeners = ['updateCharts'];

    public function mount()
    {
        $this->incidentTypes = Incident_type::all();
        $this->loadAllData();
    }

    public function updatedFilterType()
    {
        $this->applyFilters();
    }

    public function updatedStartDate()
    {
        $this->applyFilters();
    }

    public function updatedEndDate()
    {
        $this->applyFilters();
    }

    public function applyFilters()
    {
        $this->loadAllData();
        $this->dispatch('updateCharts');
    }

    public function loadAllData()
    {
        $this->loadStats();
        $this->loadCharts();
    }

    public function loadStats()
    {
        $query = $this->filteredQuery();

        $this->totalIncidents = $query->count();
        $this->totalCases = $query->where('is_case', true)->count();
        $this->totalArrests = $this->getFilteredArrestsCount();
    }

    public function getFilteredArrestsCount()
    {
        // الحصول على معرفات الوقائع المفلترة
        $filteredIncidentIds = $this->filteredQuery()->pluck('id');
        
        // حساب عدد المقبوض عليهم للوقائع المفلترة فقط
        return Arrest::whereIn('incident_id', $filteredIncidentIds)->count();
    }

    public function loadCharts()
    {
        $this->trendChartData = $this->getTrendChartData();
        $this->typePieData = $this->getTypePieChart();
        $this->sourcePieData = $this->getSourcePieChart();
        $this->governorateBarData = $this->getGovernorateBarChart();
    }

    public function filteredQuery()
    {
        $query = Incident::query();

        if ($this->filterType) {
            $query->where('incident_type_id', $this->filterType);
        }

        if ($this->startDate) {
            $query->whereDate('date', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->whereDate('date', '<=', $this->endDate);
        }

        return $query;
    }

    public function getTrendChartData()
    {
        $incidents = $this->filteredQuery()
            ->selectRaw('DATE(date) as date, COUNT(*) as count')
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
    }

    public function getTypePieChart()
    {
        $data = $this->filteredQuery()
            ->selectRaw('incident_type_id, COUNT(*) as count')
            ->groupBy('incident_type_id')
            ->get();

        $labels = [];
        $values = [];

        foreach ($data as $row) {
            $type = Incident_type::find($row->incident_type_id);
            if ($type) {
                $labels[] = $type->name;
                $values[] = $row->count;
            } else {
                $labels[] = 'غير معروف';
                $values[] = $row->count;
            }
        }

        return ['labels' => $labels, 'series' => $values];
    }

    public function getSourcePieChart()
    {
        $data = $this->filteredQuery()
            ->selectRaw('incident_source_id, COUNT(*) as count')
            ->groupBy('incident_source_id')
            ->get();

        $labels = [];
        $values = [];

        foreach ($data as $row) {
            $source = Incident_source::find($row->incident_source_id);
            if ($source) {
                $labels[] = $source->name;
                $values[] = $row->count;
            } else {
                $labels[] = 'غير معروف';
                $values[] = $row->count;
            }
        }

        return ['labels' => $labels, 'series' => $values];
    }

    public function getGovernorateBarChart()
    {
        $data = $this->filteredQuery()
            ->selectRaw('governorate_id, COUNT(*) as total')
            ->groupBy('governorate_id')
            ->get();

        $labels = [];
        $values = [];

        foreach ($data as $row) {
            $gov = Governorate::find($row->governorate_id);
            if ($gov) {
                $labels[] = $gov->name;
                $values[] = $row->total;
            } else {
                $labels[] = 'غير معروف';
                $values[] = $row->total;
            }
        }

        // إضافة اسم نوع الواقعة المحدد إذا كان موجوداً
        $chartName = 'عدد الوقائع';
        if ($this->filterType) {
            $type = Incident_type::find($this->filterType);
            if ($type) {
                $chartName = 'عدد ' . $type->name;
            }
        }

        return [
            'labels' => $labels,
            'series' => [
                [
                    'name' => $chartName,
                    'data' => $values,
                ]
            ]
        ];
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard-stats');
    }
}
