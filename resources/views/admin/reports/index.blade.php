<x-admin-layout>
    <x-slot name="header">Báo cáo doanh thu</x-slot>

    @php
        $dailyMaxOrders = max(1, max($selected['orders'] ?? [1]));
        $dailyMaxRevenue = max(1, max($selected['revenue'] ?? [1]));
        $monthlyMaxOrders = max(1, max($monthly['orders'] ?? [1]));
        $monthlyMaxRevenue = max(1, max($monthly['revenue'] ?? [1]));
        $yearlyMaxOrders = max(1, max($yearly['orders'] ?? [1]));
        $yearlyMaxRevenue = max(1, max($yearly['revenue'] ?? [1]));

        $hasDailyData = (array_sum($selected['orders'] ?? []) > 0) || (array_sum($selected['revenue'] ?? []) > 0);
        $hasMonthlyData = (array_sum($monthly['orders'] ?? []) > 0) || (array_sum($monthly['revenue'] ?? []) > 0);
        $hasYearlyData = (array_sum($yearly['orders'] ?? []) > 0) || (array_sum($yearly['revenue'] ?? []) > 0);
    @endphp

    <div class="space-y-6 bg-slate-50">
        <section class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-2xl">
                    <p class="text-sm font-semibold uppercase tracking-[0.25em] text-primary">Tổng quan kinh doanh</p>
                    <h2 class="mt-2 text-2xl font-semibold text-slate-900">Báo cáo doanh thu</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Theo dõi doanh thu, số đơn hàng và hiệu quả kinh doanh theo thời gian.
                    </p>
                </div>

                <form method="GET" action="{{ route('admin.reports.index') }}" class="flex flex-wrap gap-2">
                    @foreach([
                        'today' => 'Hôm nay',
                        '7_days' => '7 ngày',
                        '30_days' => '30 ngày',
                        'month' => 'Tháng này',
                        'year' => 'Năm nay',
                    ] as $value => $label)
                        <button
                            type="submit"
                            name="range"
                            value="{{ $value }}"
                            class="rounded-full border px-4 py-2 text-sm font-medium transition {{ request('range', '30_days') === $value ? 'border-primary bg-primary text-white shadow-sm' : 'border-slate-200 bg-slate-50 text-slate-600 hover:border-primary/40 hover:text-primary' }}"
                        >
                            {{ $label }}
                        </button>
                    @endforeach
                </form>
            </div>
        </section>

        <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Tổng doanh thu</p>
                        <p class="mt-2 text-3xl font-semibold text-slate-900">{{ number_format($summary['revenue'], 0, ',', '.') }} đ</p>
                    </div>
                    <div class="rounded-2xl bg-primary/10 p-3 text-primary">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-2.761 0-5 1.79-5 4s2.239 4 5 4 5 1.79 5 4-2.239 4-5 4m0-16c1.657 0 3 1.79 3 4m-3-4V4m0 16v-4m0-12V2"/>
                        </svg>
                    </div>
                </div>
                <p class="mt-3 text-sm text-slate-500">Tổng doanh thu từ các đơn hàng hoàn thành.</p>
            </div>

            <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Tổng đơn hàng</p>
                        <p class="mt-2 text-3xl font-semibold text-slate-900">{{ number_format($summary['total_orders']) }}</p>
                    </div>
                    <div class="rounded-2xl bg-sky-50 p-3 text-sky-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
                <p class="mt-3 text-sm text-slate-500">Tổng số đơn phát sinh trong toàn hệ thống.</p>
            </div>

            <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Đơn hoàn thành</p>
                        <p class="mt-2 text-3xl font-semibold text-slate-900">{{ number_format($summary['completed_orders']) }}</p>
                    </div>
                    <div class="rounded-2xl bg-emerald-50 p-3 text-emerald-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>
                <p class="mt-3 text-sm text-slate-500">Đơn đã được xử lý thành công.</p>
            </div>

            <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Đơn chờ xử lý</p>
                        <p class="mt-2 text-3xl font-semibold text-slate-900">{{ number_format($summary['pending_orders']) }}</p>
                    </div>
                    <div class="rounded-2xl bg-slate-100 p-3 text-slate-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="mt-3 text-sm text-slate-500">Đơn đang đợi nhân viên xử lý.</p>
            </div>
        </section>

        <section class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <div class="flex flex-col gap-2 md:flex-row md:items-end md:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.25em] text-primary">Biểu đồ & bảng dữ liệu</p>
                    <h3 class="mt-1 text-xl font-semibold text-slate-900">Doanh thu và số đơn theo thời gian</h3>
                </div>
                <p class="text-sm text-slate-500">Chuyển tab để xem theo ngày, tháng hoặc năm.</p>
            </div>

            <div class="mt-6 border-b border-slate-200">
                <div class="-mb-px flex flex-wrap gap-2" id="report-tabs">
                    <button type="button" data-tab="daily" class="report-tab rounded-t-xl border border-b-0 border-slate-200 bg-slate-50 px-4 py-2 text-sm font-medium text-slate-600">
                        Theo ngày
                    </button>
                    <button type="button" data-tab="monthly" class="report-tab rounded-t-xl border border-b-0 border-slate-200 bg-slate-50 px-4 py-2 text-sm font-medium text-slate-600">
                        Theo tháng
                    </button>
                    <button type="button" data-tab="yearly" class="report-tab rounded-t-xl border border-b-0 border-slate-200 bg-slate-50 px-4 py-2 text-sm font-medium text-slate-600">
                        Theo năm
                    </button>
                </div>
            </div>

            <div class="mt-6 space-y-6">
                <div id="tab-daily" class="report-panel">
                    <div class="grid gap-6 xl:grid-cols-5">
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 xl:col-span-3">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-primary">Biểu đồ</p>
                            <h4 class="mt-1 text-lg font-semibold text-slate-900">
                                {{ $range === 'year' ? 'Theo tháng trong năm nay' : 'Theo ngày trong khoảng đã chọn' }}
                            </h4>
                        </div>
                    </div>
                            @if($hasDailyData)
                                <div class="h-80">
                                    <canvas id="dailyChart"></canvas>
                                </div>
                            @else
                                <div class="flex h-80 items-center justify-center rounded-2xl border border-dashed border-slate-300 bg-white text-sm text-slate-500">
                                    Chưa có dữ liệu báo cáo trong khoảng thời gian này.
                                </div>
                            @endif
                        </div>

                        <div class="rounded-2xl border border-slate-200 bg-white p-4 xl:col-span-2">
                            <div class="mb-4">
                                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-primary">Bảng tóm tắt</p>
                                <h4 class="mt-1 text-lg font-semibold text-slate-900">
                                    {{ $selected['granularity'] === 'month' ? 'Tháng - Số đơn - Doanh thu' : 'Ngày - Số đơn - Doanh thu' }}
                                </h4>
                            </div>
                            <div class="max-h-80 overflow-auto rounded-xl border border-slate-200">
                                @if($hasDailyData)
                                    <table class="min-w-full divide-y divide-slate-200 text-sm">
                                        <thead class="sticky top-0 bg-slate-50">
                                            <tr>
                                                <th class="px-4 py-3 text-left font-semibold text-slate-600">{{ $selected['granularity'] === 'month' ? 'Tháng' : 'Ngày' }}</th>
                                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Số đơn</th>
                                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Doanh thu</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-100 bg-white">
                                        @foreach($selected['labels'] as $index => $label)
                                            @php
                                                $ordersValue = $selected['orders'][$index] ?? 0;
                                                $revenueValue = $selected['revenue'][$index] ?? 0;
                                            @endphp
                                            @if($ordersValue > 0 || $revenueValue > 0)
                                                <tr class="hover:bg-slate-50">
                                                        <td class="px-4 py-3 font-medium text-slate-700">{{ $label }}</td>
                                                        <td class="px-4 py-3 text-slate-600">{{ number_format($ordersValue) }}</td>
                                                        <td class="px-4 py-3 text-slate-600">{{ number_format($revenueValue, 0, ',', '.') }} đ</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="flex h-80 items-center justify-center bg-white text-sm text-slate-500">
                                        Chưa có dữ liệu báo cáo trong khoảng thời gian này.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tab-monthly" class="report-panel hidden">
                    <div class="grid gap-6 xl:grid-cols-5">
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 xl:col-span-3">
                            <div class="mb-4 flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-primary">Biểu đồ</p>
                                    <h4 class="mt-1 text-lg font-semibold text-slate-900">12 tháng gần nhất</h4>
                                </div>
                            </div>
                            @if($hasMonthlyData)
                                <div class="h-80">
                                    <canvas id="monthlyChart"></canvas>
                                </div>
                            @else
                                <div class="flex h-80 items-center justify-center rounded-2xl border border-dashed border-slate-300 bg-white text-sm text-slate-500">
                                    Chưa có dữ liệu báo cáo trong khoảng thời gian này.
                                </div>
                            @endif
                        </div>

                        <div class="rounded-2xl border border-slate-200 bg-white p-4 xl:col-span-2">
                            <div class="mb-4">
                                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-primary">Bảng tóm tắt</p>
                                <h4 class="mt-1 text-lg font-semibold text-slate-900">Thời gian - Số đơn - Doanh thu</h4>
                            </div>
                            <div class="max-h-80 overflow-auto rounded-xl border border-slate-200">
                                @if($hasMonthlyData)
                                    <table class="min-w-full divide-y divide-slate-200 text-sm">
                                        <thead class="sticky top-0 bg-slate-50">
                                            <tr>
                                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Tháng</th>
                                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Số đơn</th>
                                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Doanh thu</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-100 bg-white">
                                            @foreach($monthly['labels'] as $index => $label)
                                                @php
                                                    $ordersValue = $monthly['orders'][$index] ?? 0;
                                                    $revenueValue = $monthly['revenue'][$index] ?? 0;
                                                @endphp
                                                @if($ordersValue > 0 || $revenueValue > 0)
                                                    <tr class="hover:bg-slate-50">
                                                        <td class="px-4 py-3 font-medium text-slate-700">{{ $label }}</td>
                                                        <td class="px-4 py-3 text-slate-600">{{ number_format($ordersValue) }}</td>
                                                        <td class="px-4 py-3 text-slate-600">{{ number_format($revenueValue, 0, ',', '.') }} đ</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="flex h-80 items-center justify-center bg-white text-sm text-slate-500">
                                        Chưa có dữ liệu báo cáo trong khoảng thời gian này.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tab-yearly" class="report-panel hidden">
                    <div class="grid gap-6 xl:grid-cols-5">
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 xl:col-span-3">
                            <div class="mb-4 flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-primary">Biểu đồ</p>
                                    <h4 class="mt-1 text-lg font-semibold text-slate-900">5 năm gần nhất</h4>
                                </div>
                            </div>
                            @if($hasYearlyData)
                                <div class="h-80">
                                    <canvas id="yearlyChart"></canvas>
                                </div>
                            @else
                                <div class="flex h-80 items-center justify-center rounded-2xl border border-dashed border-slate-300 bg-white text-sm text-slate-500">
                                    Chưa có dữ liệu báo cáo trong khoảng thời gian này.
                                </div>
                            @endif
                        </div>

                        <div class="rounded-2xl border border-slate-200 bg-white p-4 xl:col-span-2">
                            <div class="mb-4">
                                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-primary">Bảng tóm tắt</p>
                                <h4 class="mt-1 text-lg font-semibold text-slate-900">Thời gian - Số đơn - Doanh thu</h4>
                            </div>
                            <div class="max-h-80 overflow-auto rounded-xl border border-slate-200">
                                @if($hasYearlyData)
                                    <table class="min-w-full divide-y divide-slate-200 text-sm">
                                        <thead class="sticky top-0 bg-slate-50">
                                            <tr>
                                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Năm</th>
                                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Số đơn</th>
                                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Doanh thu</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-100 bg-white">
                                            @foreach($yearly['labels'] as $index => $label)
                                                @php
                                                    $ordersValue = $yearly['orders'][$index] ?? 0;
                                                    $revenueValue = $yearly['revenue'][$index] ?? 0;
                                                @endphp
                                                @if($ordersValue > 0 || $revenueValue > 0)
                                                    <tr class="hover:bg-slate-50">
                                                        <td class="px-4 py-3 font-medium text-slate-700">{{ $label }}</td>
                                                        <td class="px-4 py-3 text-slate-600">{{ number_format($ordersValue) }}</td>
                                                        <td class="px-4 py-3 text-slate-600">{{ number_format($revenueValue, 0, ',', '.') }} đ</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="flex h-80 items-center justify-center bg-white text-sm text-slate-500">
                                        Chưa có dữ liệu báo cáo trong khoảng thời gian này.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
        <script>
            const reportCharts = {};

            const chartConfigs = {
                daily: {
                    labels: @json($selected['labels']),
                    orders: @json($selected['orders']),
                    revenue: @json($selected['revenue']),
                    canvasId: 'dailyChart',
                },
                monthly: {
                    labels: @json($monthly['labels']),
                    orders: @json($monthly['orders']),
                    revenue: @json($monthly['revenue']),
                    canvasId: 'monthlyChart',
                },
                yearly: {
                    labels: @json($yearly['labels']),
                    orders: @json($yearly['orders']),
                    revenue: @json($yearly['revenue']),
                    canvasId: 'yearlyChart',
                },
            };

            function buildChart(key) {
                const config = chartConfigs[key];
                const canvas = document.getElementById(config.canvasId);

                if (!canvas || reportCharts[key]) {
                    return;
                }

                reportCharts[key] = new Chart(canvas, {
                    type: 'bar',
                    data: {
                        labels: config.labels,
                        datasets: [
                            {
                                label: 'Số đơn',
                                data: config.orders,
                                backgroundColor: 'rgba(44, 127, 184, 0.75)',
                                borderRadius: 8,
                                barPercentage: 0.6,
                            },
                            {
                                label: 'Doanh thu',
                                data: config.revenue,
                                backgroundColor: 'rgba(15, 23, 42, 0.72)',
                                borderRadius: 8,
                                barPercentage: 0.6,
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    usePointStyle: true,
                                },
                            },
                            tooltip: {
                                callbacks: {
                                    label(context) {
                                        const value = Number(context.raw || 0);
                                        if (context.dataset.label === 'Doanh thu') {
                                            return `${context.dataset.label}: ${value.toLocaleString('vi-VN')} đ`;
                                        }
                                        return `${context.dataset.label}: ${value.toLocaleString('vi-VN')}`;
                                    },
                                },
                            },
                        },
                        scales: {
                            x: {
                                grid: { display: false },
                                ticks: { color: '#475569' },
                            },
                            y: {
                                beginAtZero: true,
                                grid: { color: 'rgba(148, 163, 184, 0.18)' },
                                ticks: { color: '#475569' },
                            },
                        },
                    },
                });
            }

            function setActiveTab(tabKey) {
                document.querySelectorAll('.report-tab').forEach((button) => {
                    const active = button.dataset.tab === tabKey;
                    button.classList.toggle('bg-primary', active);
                    button.classList.toggle('text-white', active);
                    button.classList.toggle('border-primary', active);
                    button.classList.toggle('bg-slate-50', !active);
                    button.classList.toggle('text-slate-600', !active);
                });

                document.querySelectorAll('.report-panel').forEach((panel) => {
                    panel.classList.toggle('hidden', panel.id !== `tab-${tabKey}`);
                });

                buildChart(tabKey);
            }

            document.querySelectorAll('.report-tab').forEach((button) => {
                button.addEventListener('click', () => setActiveTab(button.dataset.tab));
            });

            setActiveTab('daily');
        </script>
    @endpush
</x-admin-layout>
