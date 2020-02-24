<?php

namespace App\Observers;

use App\Events\LogEvent;
use App\Models\ToDo;

class ToDoObserver
{
    /**
     * @param ToDo $toDo
     */
    public function created(ToDo $toDo)
    {
        $params = [
            'id' => $toDo->id,
        ];

        event(new LogEvent('create', $toDo->user, $params));
    }

    /**
     * @param ToDo $toDo
     */
    public function updated(ToDo $toDo)
    {
        //@toDo here can add more params
        $params = [
            'id' => $toDo->id,
        ];

        event(new LogEvent('update', $toDo->user, $params));
    }
}
