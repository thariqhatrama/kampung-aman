<?php

namespace App\Policies;

use App\Models\User;
use App\Models\EdukasiHukum;
use Illuminate\Auth\Access\HandlesAuthorization;

class EdukasiHukumPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_edukasi::hukum');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, EdukasiHukum $edukasiHukum): bool
    {
        return $user->can('view_edukasi::hukum');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_edukasi::hukum');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, EdukasiHukum $edukasiHukum): bool
    {
        return $user->can('update_edukasi::hukum');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EdukasiHukum $edukasiHukum): bool
    {
        return $user->can('delete_edukasi::hukum');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_edukasi::hukum');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, EdukasiHukum $edukasiHukum): bool
    {
        return $user->can('force_delete_edukasi::hukum');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_edukasi::hukum');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, EdukasiHukum $edukasiHukum): bool
    {
        return $user->can('restore_edukasi::hukum');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_edukasi::hukum');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, EdukasiHukum $edukasiHukum): bool
    {
        return $user->can('replicate_edukasi::hukum');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_edukasi::hukum');
    }
}
