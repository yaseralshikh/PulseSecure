<div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-2xl shadow p-4">
            <h2 class="text-gray-500 text-sm">إجمالي الوقوعات</h2>
            <p class="text-2xl font-bold text-gray-800">{{ $totalIncidents }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow p-4">
            <h2 class="text-gray-500 text-sm">إجمالي القضايا</h2>
            <p class="text-2xl font-bold text-gray-800">{{ $totalCases }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow p-4">
            <h2 class="text-gray-500 text-sm">إجمالي المقبوض عليهم</h2>
            <p class="text-2xl font-bold text-gray-800">{{ $totalArrests }}</p>
        </div>
    </div>
</div>
