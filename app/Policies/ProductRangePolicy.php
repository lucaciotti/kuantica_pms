<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ProductRange;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductRangePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ProductRange');
    }

    public function view(AuthUser $authUser, ProductRange $productRange): bool
    {
        return $authUser->can('View:ProductRange');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ProductRange');
    }

    public function update(AuthUser $authUser, ProductRange $productRange): bool
    {
        return $authUser->can('Update:ProductRange');
    }

    public function delete(AuthUser $authUser, ProductRange $productRange): bool
    {
        return $authUser->can('Delete:ProductRange');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:ProductRange');
    }

    public function restore(AuthUser $authUser, ProductRange $productRange): bool
    {
        return $authUser->can('Restore:ProductRange');
    }

    public function forceDelete(AuthUser $authUser, ProductRange $productRange): bool
    {
        return $authUser->can('ForceDelete:ProductRange');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ProductRange');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ProductRange');
    }

    public function replicate(AuthUser $authUser, ProductRange $productRange): bool
    {
        return $authUser->can('Replicate:ProductRange');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ProductRange');
    }

}