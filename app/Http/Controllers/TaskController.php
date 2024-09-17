<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddNoteTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateStatusTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

/**
 * Class TaskController
 * @package App\Http\Controllers
 */
class TaskController extends Controller implements HasMiddleware
{
    /**
     * @var TaskService
     */
    protected $taskService;

    /**
     * TaskController constructor.
     * @param TaskService $taskService
     */
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware('Admin', only: ['destroy']),
        ];
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();
        $task = $this->taskService->createTask($validated);
        return $this->sendResponse($task, 'the task has been retrieved successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, $taskId)
    {
        try {
            $validated = $request->validated();
            $task = $this->taskService->updateTask($validated, $taskId);
            return $this->sendResponse($task, 'task has been updated successfully');
        } catch (ModelNotFoundException $e) {
            return $this->sendError('update Status failed', ['errors' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($taskId)
    {
        $this->taskService->deleteTask($taskId);
        return $this->sendResponse([], 'task has been deleted successfully');
    }

    /**
     * @param UpdateStatusTaskRequest $request
     * @param $taskId
     * @return \Illuminate\Http\Response
     */
    public function updateStatusTask(UpdateStatusTaskRequest $request, $taskId)
    {
        try {
            $validated = $request->validated();
            $task = $this->taskService->updateStatusTask($validated['status'], $taskId);
            return $this->sendResponse($task, 'task has been updated successfully');
        } catch (ModelNotFoundException $e) {
           return $this->sendError('update Status failed', ['errors' => $e->getMessage()]);
        }
    }

    /**
     * @param AddNoteTaskRequest $request
     * @param $taskId
     * @return \Illuminate\Http\Response
     */
    public function addNoteToTask(AddNoteTaskRequest $request, $taskId)
    {
        try {
            $validated = $request->validated();
            $task = $this->taskService->addNoteToTask($validated['note'], $taskId);
            return $this->sendResponse($task, 'task has been added note successfully');
        } catch (ModelNotFoundException $e) {
           return $this->sendError('update failed', ['errors' => $e->getMessage()]);
        }
    }

    /**
     * @param $taskId
     * @return \Illuminate\Http\Response
     */
    public function show($taskId){
        try {
            $task = $this->taskService->getTaskById($taskId);
            return $this->sendResponse($task, 'task has been retieved successfully');
        } catch (ModelNotFoundException $e) {
           return $this->sendError('retrieved task failed', ['errors' => $e->getMessage()]);
        }
    }

}
