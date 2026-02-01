<?php

namespace App\Policies;

use App\Models\LeaveRequest;
use App\Models\User;

class LeaveRequestPolicy
{
    public function viewAny(User $user): bool
    {
        return true; // Semua bisa liat menu-nya
    }

    public function view(User $user, LeaveRequest $leaveRequest): bool
    {
        // Admin bisa liat semua, Staff cuma bisa liat punya sendiri
        return $user->isAdmin() || $user->id === $leaveRequest->user_id;
    }

    public function create(User $user): bool
    {
        // Sesuai request, Admin gak boleh input cuti (purely approver)
        return !$user->isAdmin();
    }

    public function update(User $user, LeaveRequest $leaveRequest): bool
    {
        // Staff cuma bisa edit kalo status masih 'pending'
        if (!$user->isAdmin()) {
            return $user->id === $leaveRequest->user_id && $leaveRequest->status === 'pending';
        }
        
        return true; // Admin mah bebas
    }

    public function delete(User $user, LeaveRequest $leaveRequest): bool
    {
        // Cuma bisa hapus kalo masih pending
        return ($user->isAdmin() || $user->id === $leaveRequest->user_id) && $leaveRequest->status === 'pending';
    }
}