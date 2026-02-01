<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class LeaveTrendChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Tren Cuti Tahunan';

    protected function getData(): array
    {
        $data = [];
        $months = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->format('M Y');
            
            $count = \App\Models\LeaveRequest::where('status', 'approved')
                ->whereYear('updated_at', $date->year)
                ->whereMonth('updated_at', $date->month)
                ->count();
            
            $data[] = $count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Cuti Disetujui',
                    'data' => $data,
                    'fill' => 'start',
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'tension' => 0.4,
                ],
            ],
            'labels' => $months,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
