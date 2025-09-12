<div>
    <div class="bg-white rounded-2xl shadow p-4">
        <h2 class="text-lg font-semibold mb-2">نسبة أنواع الوقائع</h2>
        <div id="incident-types-chart" style="height: 300px;"></div>

        <script>
            document.addEventListener('livewire:init', () => {
                const options = {
                    chart: {
                        type: 'pie',
                        height: 300
                    },
                    labels: @js($incidentTypesData['labels']),
                    series: @js($incidentTypesData['series']),
                    colors: ['#f87171', '#60a5fa', '#34d399', '#fbbf24', '#a78bfa'], // يمكنك تخصيص الألوان
                };

                const chart = new ApexCharts(document.querySelector("#incident-types-chart"), options);
                chart.render();
            });
        </script>
    </div>   
</div>
