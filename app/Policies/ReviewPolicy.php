<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;

class ReviewPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Review $review): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $review->user_id === $user->id && ! $review->is_approved;
    }

    public function delete(User $user, Review $review): bool
    {
        return $user->isAdmin();
    }
}
