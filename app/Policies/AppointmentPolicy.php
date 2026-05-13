<?php

namespace App\Policies;

use App\Models\Appointment;
use App\Models\User;

class AppointmentPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Appointment $appointment): bool
    {
        return $user->isAdmin() || $appointment->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Appointment $appointment): bool
    {
        return $user->isAdmin() || $appointment->user_id === $user->id;
    }

    public function delete(User $user, Appointment $appointment): bool
    {
        return $user->isAdmin();
    }

    public function cancel(User $user, Appointment $appointment): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($appointment->user_id !== $user->id) {
            return false;
        }

        return in_array($appointment->status, [
            Appointment::STATUS_PENDING,
            Appointment::STATUS_CONFIRMED,
        ], true);
    }
}
