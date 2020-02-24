<?php

namespace App\Policies;

use App\Models\ToDo;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ToDoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @param ToDo $toDo
     * @return bool
     */
    public function destroy(User $user, ToDo $toDo)
    {
        return !($user->admin);
    }
}
