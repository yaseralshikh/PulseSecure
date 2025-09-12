<div>
    <div class="bg-white rounded-xl p-4">
        <h2 class="text-lg font-semibold mb-2">عدد الوقائع حسب المحافظة</h2>
        <div id="governorates-chart" style="height: 400px;"></div>

        <script>
            document.addEventListener('livewire:init', () => {
                const options = {
                    chart: {
                        type: 'bar',
                        height: 400,
                    },
                    series: @js($chartData['series']),
                    xaxis: {
                        categories: @js($chartData['labels']),
                    },
                    colors: ['#3b82f6'],
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '50%',
                        }
                    },
                    dataLabels: {
                        enabled: true,
                    },
                    tooltip: {
                        y: {
                            formatter: val => `${val} واقعة`
                        }
                    }
                };

                const chart = new ApexCharts(document.querySelector("#governorates-chart"), options);
                chart.render();
            });
        </script>
    </div>
</div>
