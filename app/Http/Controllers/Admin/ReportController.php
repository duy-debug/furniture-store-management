<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(Request $request): View
    {
        $range = $request->string('range', '30_days')->toString();
        $period = $this->resolvePeriod($range);

        $summary = [
            'total_orders' => Order::query()
                ->whereBetween('placed_at', [$period['start'], $period['end']])
                ->count(),
            'completed_orders' => Order::query()
                ->whereBetween('placed_at', [$period['start'], $period['end']])
                ->where('status', 'completed')
                ->count(),
            'revenue' => Order::query()
                ->whereBetween('placed_at', [$period['start'], $period['end']])
                ->where('status', 'completed')
                ->sum('total_amount'),
            'pending_orders' => Order::query()
                ->whereBetween('placed_at', [$period['start'], $period['end']])
                ->where('status', 'pending')
                ->count(),
            'cancelled_orders' => Order::query()
                ->whereBetween('placed_at', [$period['start'], $period['end']])
                ->where('status', 'cancelled')
                ->count(),
        ];

        $selected = $this->buildSelectedSeries($period);
        $daily = $this->buildDailySeries();
        $monthly = $this->buildMonthlySeries();
        $yearly = $this->buildYearlySeries();

        return view('admin.reports.index', compact('summary', 'selected', 'daily', 'monthly', 'yearly', 'range'));
    }

    private function resolvePeriod(string $range): array
    {
        return match ($range) {
            'today' => [
                'key' => 'today',
                'label' => 'Hôm nay',
                'start' => now()->startOfDay(),
                'end' => now()->endOfDay(),
            ],
            '7_days' => [
                'key' => '7_days',
                'label' => '7 ngày',
                'start' => now()->subDays(6)->startOfDay(),
                'end' => now()->endOfDay(),
            ],
            'month' => [
                'key' => 'month',
                'label' => 'Tháng này',
                'start' => now()->startOfMonth(),
                'end' => now()->endOfDay(),
            ],
            'year' => [
                'key' => 'year',
                'label' => 'Năm nay',
                'start' => now()->startOfYear(),
                'end' => now()->endOfDay(),
            ],
            default => [
                'key' => '30_days',
                'label' => '30 ngày',
                'start' => now()->subDays(29)->startOfDay(),
                'end' => now()->endOfDay(),
            ],
        };
    }

    private function buildSelectedSeries(array $period): array
    {
        if ($period['key'] === 'year') {
            return array_merge($this->buildMonthlySeriesBetween($period['start'], $period['end']), [
                'granularity' => 'month',
            ]);
        }

        return array_merge($this->buildDailySeriesBetween($period['start'], $period['end']), [
            'granularity' => 'day',
        ]);
    }

    private function buildDailySeries(): array
    {
        return $this->buildDailySeriesBetween(now()->startOfDay()->subDays(29), now()->startOfDay());
    }

    private function buildDailySeriesBetween($start, $end): array
    {
        $rows = Order::query()
            ->selectRaw('DATE(placed_at) as label, COUNT(*) as total_orders, COALESCE(SUM(total_amount), 0) as revenue')
            ->where('status', 'completed')
            ->whereBetween('placed_at', [$start, $end])
            ->groupBy(DB::raw('DATE(placed_at)'))
            ->orderBy('label')
            ->get()
            ->keyBy('label');

        $labels = [];
        $orders = [];
        $revenue = [];

        for ($date = $start->copy(); $date <= $end->copy()->startOfDay(); $date->addDay()) {
            $key = $date->toDateString();
            $row = $rows->get($key);

            $labels[] = $date->format('d/m');
            $orders[] = (int) ($row->total_orders ?? 0);
            $revenue[] = (float) ($row->revenue ?? 0);
        }

        return compact('labels', 'orders', 'revenue');
    }

    private function buildMonthlySeriesBetween($start, $end): array
    {
        $rows = Order::query()
            ->selectRaw('DATE_FORMAT(placed_at, "%Y-%m") as label, COUNT(*) as total_orders, COALESCE(SUM(total_amount), 0) as revenue')
            ->where('status', 'completed')
            ->whereBetween('placed_at', [$start, $end])
            ->groupBy(DB::raw('DATE_FORMAT(placed_at, "%Y-%m")'))
            ->orderBy('label')
            ->get()
            ->keyBy('label');

        $labels = [];
        $orders = [];
        $revenue = [];

        for ($date = $start->copy()->startOfMonth(); $date <= $end->copy()->startOfMonth(); $date->addMonth()) {
            $key = $date->format('Y-m');
            $row = $rows->get($key);

            $labels[] = $date->format('m/Y');
            $orders[] = (int) ($row->total_orders ?? 0);
            $revenue[] = (float) ($row->revenue ?? 0);
        }

        return compact('labels', 'orders', 'revenue');
    }

    private function buildMonthlySeries(): array
    {
        $start = now()->startOfMonth()->subMonths(11);

        $rows = Order::query()
            ->selectRaw('DATE_FORMAT(placed_at, "%Y-%m") as label, COUNT(*) as total_orders, COALESCE(SUM(total_amount), 0) as revenue')
            ->where('status', 'completed')
            ->whereDate('placed_at', '>=', $start->toDateString())
            ->groupBy(DB::raw('DATE_FORMAT(placed_at, "%Y-%m")'))
            ->orderBy('label')
            ->get()
            ->keyBy('label');

        $labels = [];
        $orders = [];
        $revenue = [];

        for ($date = $start->copy(); $date <= now()->startOfMonth(); $date->addMonth()) {
            $key = $date->format('Y-m');
            $row = $rows->get($key);

            $labels[] = $date->format('m/Y');
            $orders[] = (int) ($row->total_orders ?? 0);
            $revenue[] = (float) ($row->revenue ?? 0);
        }

        return compact('labels', 'orders', 'revenue');
    }

    private function buildYearlySeries(): array
    {
        $startYear = now()->year - 4;
        $endYear = now()->year;

        $rows = Order::query()
            ->selectRaw('YEAR(placed_at) as label, COUNT(*) as total_orders, COALESCE(SUM(total_amount), 0) as revenue')
            ->where('status', 'completed')
            ->whereYear('placed_at', '>=', $startYear)
            ->groupBy(DB::raw('YEAR(placed_at)'))
            ->orderBy('label')
            ->get()
            ->keyBy('label');

        $labels = [];
        $orders = [];
        $revenue = [];

        for ($year = $startYear; $year <= $endYear; $year++) {
            $row = $rows->get($year);

            $labels[] = (string) $year;
            $orders[] = (int) ($row->total_orders ?? 0);
            $revenue[] = (float) ($row->revenue ?? 0);
        }

        return compact('labels', 'orders', 'revenue');
    }
}
