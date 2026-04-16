<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\OrderImportFile;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderImportFilePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:OrderImportFile');
    }

    public function view(AuthUser $authUser, OrderImportFile $orderImportFile): bool
    {
        return $authUser->can('View:OrderImportFile');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:OrderImportFile');
    }

    public function update(AuthUser $authUser, OrderImportFile $orderImportFile): bool
    {
        return $authUser->can('Update:OrderImportFile');
    }

    public function delete(AuthUser $authUser, OrderImportFile $orderImportFile): bool
    {
        return $authUser->can('Delete:OrderImportFile');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:OrderImportFile');
    }

    public function restore(AuthUser $authUser, OrderImportFile $orderImportFile): bool
    {
        return $authUser->can('Restore:OrderImportFile');
    }

    public function forceDelete(AuthUser $authUser, OrderImportFile $orderImportFile): bool
    {
        return $authUser->can('ForceDelete:OrderImportFile');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:OrderImportFile');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:OrderImportFile');
    }

    public function replicate(AuthUser $authUser, OrderImportFile $orderImportFile): bool
    {
        return $authUser->can('Replicate:OrderImportFile');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:OrderImportFile');
    }

}