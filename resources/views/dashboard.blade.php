<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <livewire:dashboard-stats />
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative rounded-xl overflow-hidden p-4">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
                
                <div class="relative z-10">
                    <livewire:dashboard.incident-types-chart />
                </div>
            </div>
            <div class="relative rounded-xl overflow-hidden p-4">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
                
                <div class="relative z-10">
                    <livewire:dashboard.incident-sources-chart />
                </div>
            </div>
            <div class="relative rounded-xl p-4">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
                <livewire:dashboard.governorate-incidents-chart />
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            <livewire:dashboard.incident-trend-chart />
        </div>
    </div>
</x-layouts.app>
