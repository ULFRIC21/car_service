<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WorkOrder;

class WorkOrderPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, WorkOrder $workOrder): bool
    {
        return $user->isAdmin() || $workOrder->user_id === $user->id;
    }
}
