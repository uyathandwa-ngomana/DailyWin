<?php

namespace App\Policies;

use App\Models\TaskAZU;
use App\Models\UserAZU;

//Defines authorization rules for task model actions.//
/*Controls what actions users can perform based on roles 
and ownership of tasks(admin, team members, guests.)*/
class TaskPolicyAZU
{
    /**
     * Determine whether the user can view task list.
     */
    public function viewAny(UserAZU $user): bool
    {
        return !$user->isGuest();
    }

    /**
     * Determine whether the user can view a specific task.
     * Users can view tasks they created, are assigned to, or if they are administrators.
     */
    public function view(UserAZU $user, TaskAZU $task): bool
    {
        return $user->isAdmin() || $user->id === $task->created_by || $user->id === $task->assigned_to;
    }

    /**
     * Determine whether the user can create tasks.
     */
    public function create(UserAZU $user): bool
    {
        return $user->isAdmin() || $user->isTeamMember();
    }

    /**
     * Determine whether the user can update a task.
     * 
     * Allows updates only for admins, creators or assignees.
     */
    public function update(UserAZU $user, TaskAZU $task): bool
    {
        return $user->isAdmin() || $user->id === $task->created_by || $user->id === $task->assigned_to;
    }

    /**
     * Determine whether the user can delete a task.
     * 
     * Only admins and task creators can delete tasks.
     */
    public function delete(UserAZU $user, TaskAZU $task): bool
    {
        return $user->isAdmin() || $user->id === $task->created_by;
    }

    /**
     * Determine whether user can assign tasks to others.
     *
     * Only administrators are allowed to assign tasks.
     */
    public function assign(UserAZU $user): bool
    {
        return $user->isAdmin();
    }


    /**
     * Admin only access for restoring deleted tasks.
     * Admin only permanent deletion of tasks.
     */
    public function restore(UserAZU $user, TaskAZU $task): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserAZU $user, TaskAZU $task): bool
    {
        return $user->isAdmin();
    }
}
