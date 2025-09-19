<div>
    {{-- ✅ الفلاتر --}}
    <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4 pt-1.5">
        <div class="bg-gray-50 rounded-2xl shadow p-4">
            <label for="filterType" class="block mb-1">نوع الواقعة</label>
            <select wire:model.live="filterType" id="filterType" class="w-full rounded border-gray-300">
                <option value="">الكل</option>
                @foreach($incidentTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="bg-gray-50 rounded-2xl shadow p-4">
            <label for="startDate" class="block mb-1">من تاريخ</label>
            <input wire:model.live="startDate" type="date" id="startDate" class="w-full rounded border-gray-300" />
        </div>

        <div class="bg-gray-50 rounded-2xl shadow p-4">
            <label for="endDate" class="block mb-1">إلى تاريخ</label>
            <input wire:model.live="endDate" type="date" id="endDate" class="w-full rounded border-gray-300" />
        </div>
    </div>

    {{-- ✅ كروت الإحصائيات --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl p-4 shadow">
            <h3 class="text-sm text-gray-500">إجمالي الوقوعات</h3>
            <p class="text-2xl font-bold text-blue-700">{{ $totalIncidents }}</p>
        </div>

        <div class="bg-white rounded-xl p-4 shadow">
            <h3 class="text-sm text-gray-500">إجمالي القضايا</h3>
            <p class="text-2xl font-bold text-blue-700">{{ $totalCases }}</p>
        </div>

        <div class="bg-white rounded-xl p-4 shadow">
            <h3 class="text-sm text-gray-500">إجمالي المقبوض عليهم</h3>
            <p class="text-2xl font-bold text-blue-700">{{ $totalArrests }}</p>
        </div>
    </div>

    {{-- ✅ مؤشر التحميل --}}
    <div wire:loading class="fixed top-0 left-0 right-0 bg-blue-500 text-white py-2 text-center">
        جاري تحديث البيانات...
    </div>

    {{-- ✅ الرسوم البيانية --}}
    <div class="grid auto-rows-min gap-4 md:grid-cols-3">
        {{-- رسم أنواع الوقائع --}}
        <div class="bg-white rounded-xl p-4 shadow">
            <h2 class="text-lg font-semibold mb-2">نسبة أنواع الوقائع</h2>
            <div id="incident-types-chart" style="height: 300px;"></div>
        </div>

        {{-- رسم مصادر الوقائع --}}
        <div class="bg-white rounded-xl p-4 shadow">
            <h2 class="text-lg font-semibold mb-2">نسبة مصادر الوقائع</h2>
            <div id="incident-sources-chart" style="height: 300px;"></div>
        </div>

        {{-- رسم المحافظات --}}
        <div class="bg-white rounded-xl p-4 shadow">
            <h2 class="text-lg font-semibold mb-2">عدد الوقائع حسب المحافظة</h2>
            <div id="governorates-chart" style="height: 300px;"></div>
        </div>
    </div>

    {{-- الرسم البياني للاتجاه الزمني --}}
    <div class="mt-6 bg-white rounded-2xl shadow p-4">
        <h2 class="text-lg font-semibold mb-2">رسم بياني: الوقوعات حسب التاريخ</h2>
        <div id="incidents-chart" style="height: 300px;"></div>
    </div>

    {{-- ✅ السكريبتات الخاصة بالرسوم البيانية --}}
    <script>
        // متغيرات عالمية لتخزين الرسوم البيانية
        let typeChart, sourceChart, govChart, trendChart;
        let chartsInitialized = false;

        // وظيفة لتحديث الرسوم البيانية باستخدام البيانات من Livewire
        function updateAllCharts() {
            if (!chartsInitialized) return;
            
            // تحديث رسم أنواع الوقائع
            if (typeChart) {
                typeChart.updateOptions({
                    labels: @json($typePieData['labels'])
                });
                typeChart.updateSeries(@json($typePieData['series']));
            }
            
            // تحديث رسم مصادر الوقائع
            if (sourceChart) {
                sourceChart.updateOptions({
                    labels: @json($sourcePieData['labels'])
                });
                sourceChart.updateSeries(@json($sourcePieData['series']));
            }
            
            // تحديث رسم المحافظات
            if (govChart) {
                govChart.updateOptions({
                    xaxis: {
                        categories: @json($governorateBarData['labels'])
                    }
                });
                govChart.updateSeries(@json($governorateBarData['series']));
            }
            
            // تحديث الرسم البياني الزمني
            if (trendChart) {
                trendChart.updateOptions({
                    xaxis: {
                        categories: @json($trendChartData['labels'])
                    }
                });
                trendChart.updateSeries(@json($trendChartData['series']));
            }
        }

        // وظيفة لتهيئة الرسوم البيانية
        function initCharts() {
            if (chartsInitialized) return;
            
            // التأكد من وجود عناصر DOM قبل الرسم
            const typeChartEl = document.querySelector("#incident-types-chart");
            const sourceChartEl = document.querySelector("#incident-sources-chart");
            const govChartEl = document.querySelector("#governorates-chart");
            const trendChartEl = document.querySelector("#incidents-chart");
            
            if (!typeChartEl || !sourceChartEl || !govChartEl || !trendChartEl) {
                return;
            }
            
            // تنظيف العناصر قبل الرسم
            typeChartEl.innerHTML = '';
            sourceChartEl.innerHTML = '';
            govChartEl.innerHTML = '';
            trendChartEl.innerHTML = '';
            
            // رسم أنواع الوقائع
            const typeOptions = {
                chart: {
                    type: 'pie',
                    height: 300,
                    fontFamily: 'inherit'
                },
                labels: @json($typePieData['labels']),
                series: @json($typePieData['series']),
                colors: ['#f87171', '#60a5fa', '#34d399', '#fbbf24', '#a78bfa', '#f472b6', '#fb923c'],
                legend: {
                    position: 'bottom'
                }
            };
            
            typeChart = new ApexCharts(typeChartEl, typeOptions);
            typeChart.render();

            // رسم مصادر الوقائع
            const sourceOptions = {
                chart: {
                    type: 'pie',
                    height: 300,
                    fontFamily: 'inherit'
                },
                labels: @json($sourcePieData['labels']),
                series: @json($sourcePieData['series']),
                colors: ['#60a5fa', '#34d399', '#fbbf24', '#a78bfa', '#f472b6', '#fb923c', '#f87171'],
                legend: {
                    position: 'bottom'
                }
            };
            
            sourceChart = new ApexCharts(sourceChartEl, sourceOptions);
            sourceChart.render();

            // رسم المحافظات
            const govOptions = {
                chart: {
                    type: 'bar',
                    height: 300,
                    fontFamily: 'inherit'
                },
                series: @json($governorateBarData['series']),
                xaxis: {
                    categories: @json($governorateBarData['labels'])
                },
                colors: ['#3b82f6'],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '50%',
                    }
                },
                dataLabels: {
                    enabled: true
                }
            };
            
            govChart = new ApexCharts(govChartEl, govOptions);
            govChart.render();

            // رسم الاتجاه الزمني
            const trendOptions = {
                chart: {
                    type: 'line',
                    height: 300,
                    fontFamily: 'inherit',
                    zoom: {
                        enabled: true
                    }
                },
                series: @json($trendChartData['series']),
                xaxis: {
                    categories: @json($trendChartData['labels'])
                },
                colors: ['#2563eb'],
                stroke: {
                    curve: 'smooth',
                    width: 3
                }
            };
            
            trendChart = new ApexCharts(trendChartEl, trendOptions);
            trendChart.render();
            
            chartsInitialized = true;
        }

        // تهيئة الرسوم عند تحميل الصفحة
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof ApexCharts !== 'undefined') {
                initCharts();
            } else {
                // إعادة المحاولة إذا لم تكن المكتبة محملة بعد
                setTimeout(() => {
                    if (typeof ApexCharts !== 'undefined') {
                        initCharts();
                    }
                }, 100);
            }
        });

        // الاستماع لأحداث Livewire
        document.addEventListener("livewire:init", () => {
            // تحديث الرسوم عند استقبال حدث من Livewire
            Livewire.on('updateCharts', () => {
                updateAllCharts();
            });
        });

        // إعادة تهيئة الرسوم عند التنقل بين الصفحات
        document.addEventListener("livewire:navigated", () => {
            if (typeChart) typeChart.destroy();
            if (sourceChart) sourceChart.destroy();
            if (govChart) govChart.destroy();
            if (trendChart) trendChart.destroy();
            
            typeChart = null;
            sourceChart = null;
            govChart = null;
            trendChart = null;
            chartsInitialized = false;
            
            setTimeout(initCharts, 100);
        });
    </script>
</div>