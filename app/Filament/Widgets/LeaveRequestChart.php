<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class LeaveRequestChart extends ChartWidget
{
    protected static ?string $heading = 'Statistik Pengajuan Cuti';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pengajuan',
                    'data' => [
                        \App\Models\LeaveRequest::where('status', 'pending')->count(),
                        \App\Models\LeaveRequest::where('status', 'approved')->count(),
                        \App\Models\LeaveRequest::where('status', 'rejected')->count(),
                    ],
                    'backgroundColor' => [
                        '#fbbf24', // Warning (Pending)
                        '#34d399', // Success (Approved)
                        '#f87171', // Danger (Rejected)
                    ],
                ],
            ],
            'labels' => ['Pending', 'Approved', 'Rejected'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
