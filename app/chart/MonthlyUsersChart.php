<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\BarChart;
use ArielMejiaDev\LarapexCharts\AreaChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyUsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): AreaChart
    {
        // Fetch user registration data grouped by month
        $monthlyRegistrations = \App\Models\User::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        // Initialize an array for user counts
        $userCounts = array_fill(1, 12, 0); // 12 months

        // Fill the user counts with actual data
        foreach ($monthlyRegistrations as $month => $count) {
            $userCounts[$month] = $count;
        }

        return $this->chart->areaChart()
            ->setTitle('Register Clients')
            ->addData('Registered Users', array_values($userCounts))
            ->setXAxis(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])
            ->setColors(['#2ccdc9']);
    }
}
