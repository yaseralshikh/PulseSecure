<div>
    <h2 class="text-lg font-semibold mb-2">نسبة مصادر الوقائع</h2>
    <div id="incident-sources-chart" style="height: 300px;"></div>

    <script>
        document.addEventListener('livewire:init', () => {
            const options = {
                chart: {
                    type: 'pie',
                    height: 300
                },
                series: @js($chartData['series']),
                labels: @js($chartData['labels']),
                legend: {
                    position: 'right'
                }
            };

            const chart = new ApexCharts(document.querySelector("#incident-sources-chart"), options);
            chart.render();
        });
    </script>
</div>
