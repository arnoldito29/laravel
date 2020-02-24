<?php

namespace App\Services;

use App\Models\ToDo;
use App\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Config;

class ToDoService
{
    /**
     * @var ToDo
     */
    protected $toDo;

    /**
     * @var Config
     */
    protected $config;

    /**
     * ToDoService constructor.
     * @param ToDo $toDo
     * @param Config $config
     */
    public function __construct(ToDo $toDo, Config $config)
    {
        $this->toDo = $toDo;
        $this->config = $config;
    }

    /**
     * @param User|null $user
     * @return LengthAwarePaginator
     */
    public function getItems(?User $user = null): LengthAwarePaginator
    {
        $list = $this->toDo::select('*');

        if (!empty($user)) {
            $list = $list->where('user_id');
        }

        return $list->paginate($this->config::get('list.per_page'));
    }

    /**
     * @param array $requestData
     * @param User $user
     * @return ToDo
     */
    public function store(array $requestData, User $user): ToDo
    {
        $item = new ToDo();
        $item->user_id = $user->id;
        $item->content = $requestData['content'];
        $item->save();

        return $item;
    }

    /**
     * @param ToDo $toDo
     * @param array $requestData
     * @return ToDo
     */
    public function update(ToDo $toDo, array $requestData): ToDo
    {
        $toDo->content = $requestData['content'];
        $toDo->save();

        return $toDo;
    }

    /**
     * @param ToDo $toDo
     * @return bool
     * @throws \Exception
     */
    public function destroy(ToDo $toDo): bool
    {
        return $toDo->delete();
    }
}

