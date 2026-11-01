<?php

namespace App\Observers;

use App\Models\RoleChangeLog;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
            if (! $user->wasChanged('role')) {
                return;
            }

            RoleChangeLog::create([
                'user_id'    => $user->id,
                'old_role'   => $user->getOriginal('role'),
                'new_role'   => $user->role,
                'changed_by' => auth()->id(),
            ]);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
