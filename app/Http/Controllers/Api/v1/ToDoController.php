<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ToDoRequest;
use App\Http\Resources\ToDoResource;
use App\Models\ToDo;
use App\Services\ToDoService;
use Illuminate\Http\Request;

class ToDoController extends Controller
{
    /**
     * @var ToDoService
     */
    protected $toDoService;

    /**
     * ToDoController constructor.
     * @param ToDoService $toDoService
     */
    public function __construct(ToDoService $toDoService)
    {
        $this->toDoService = $toDoService;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $list = $this->toDoService->getItems();

        return ToDoResource::collection($list);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function me(Request $request)
    {
        $user = $request->user();
        $list = $this->toDoService->getItems($user);

        return ToDoResource::collection($list);
    }

    /**
     * @param ToDoRequest $request
     * @return ToDoResource
     */
    public function store(ToDoRequest $request)
    {
        $item = $this->toDoService->store($request->all(), $request->user());

        return new ToDoResource($item);
    }

    /**
     * @param ToDo $toDo
     * @param ToDoRequest $request
     * @return ToDoResource
     */
    public function update(ToDo $toDo, ToDoRequest $request)
    {
        $item = $this->toDoService->update($toDo, $request->all());

        return new ToDoResource($item);
    }

    /**
     * @param ToDo $toDo
     * @return array
     * @throws \Exception
     */
    public function destroy(ToDo $toDo)
    {
        $this->authorize('destroy', $toDo);
        $status = $this->toDoService->destroy($toDo);

        return ['status' => $status];
    }
}

