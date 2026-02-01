<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return [
                Stat::make('Total Pending', \App\Models\LeaveRequest::where('status', 'pending')->count())
                    ->description('Perlu di-review bos!')
                    ->descriptionIcon('heroicon-m-clock')
                    ->color('warning'),
                
                Stat::make('Total Karyawan', \App\Models\User::where('role', 'user')->count())
                    ->description('Jumlah anak buah lo')
                    ->descriptionIcon('heroicon-m-users')
                    ->color('primary'),

                Stat::make('Approved Today', \App\Models\LeaveRequest::where('status', 'approved')->whereDate('updated_at', today())->count())
                    ->description('Sudah di-approve hari ini')
                    ->descriptionIcon('heroicon-m-check-badge')
                    ->color('success'),
            ];
        }

        return [
            Stat::make('Sisa Cuti Tahunan', $user->leave_balance . ' Hari')
                ->description('Jatah cuti lo tinggal segini tot')
                ->descriptionIcon('heroicon-m-calendar')
                ->color($user->leave_balance > 3 ? 'success' : 'danger'),

            Stat::make('Pending Pengajuan', $user->leaveRequests()->where('status', 'pending')->count())
                ->description('Lagi nunggu hidayah admin')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color('warning'),
        ];
    }
}
