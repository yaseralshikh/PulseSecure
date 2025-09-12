<div>
    <div class="bg-white rounded-2xl shadow p-4">
        <h2 class="text-lg font-semibold mb-2">رسم بياني: الوقوعات حسب التاريخ</h2>
        <div id="incidents-chart" style="height: 300px;"></div>

        <script>
            document.addEventListener('livewire:init', () => {
                const options = {
                    chart: {
                        type: 'line',
                        height: 300
                    },
                    series: @js($chartData['series']),
                    xaxis: {
                        categories: @js($chartData['labels'])
                    },
                    colors: ['#2563eb'],
                    stroke: {
                        curve: 'smooth'
                    }
                };

                const chart = new ApexCharts(document.querySelector("#incidents-chart"), options);
                chart.render();
            });
        </script>
    </div> 
</div>
