<?php

namespace App\Services;

use App\Enums\TaskStatus;
use App\Models\ProjectUser;
use App\Models\Task;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Gate;

/**
 * Class TaskService
 * @package App\Services
 */
class TaskService
{
    /**
     * @param array $data
     * @return Task
     */
    public function createTask(array $data)
    {

        return Task::create([
            'project_user_id' => $data['project_user_id'],
            'title' => $data['title'],
            'status' => TaskStatus::NEW,
            'priority' => $data['priority'],
            'work_hours' => $data['work_hours'],
            'description' => $data['description']
        ]);
    }

    /**
     * @param array $data
     * @param $taskId
     * @return Task
     */
    public function updateTask(array $data, $taskId)
    {
        $task = Task::find($taskId);
        if (!$task) {
            throw new ModelNotFoundException('the task with given id is not found');
        }
        $task->update([
            'title' => isset($data['title']) ? $data['title'] : $task->title,
            'priority' => isset($data['priority']) ? $data['priority'] : $task->priority,
            'work_hours' => isset($data['work_hours']) ? $data['work_hours'] : $task->work_hours,
            'description' => isset($data['description']) ? $data['description'] : $task->description
        ]);
        return $task;
    }

    /**
     * @param $taskId
     * @return Task
     */
    public function getTaskById($taskId)
    {
        $task = Task::find($taskId);
        if (!$task) {
            throw new ModelNotFoundException('the task with given id is not found');
        }
        return $task;
    }

    /**
     * @param $taskId
     */
    public function deleteTask($taskId)
    {
        $task = Task::find($taskId);
        if (!$task) {
            throw new ModelNotFoundException('the task with given id is not found');
        }
        $task->delete();
    }

    /**
     * @param $newStatus
     * @param $taskId
     * @return Task
     */
    public function updateStatusTask($newStatus, $taskId)
    {
        $task = Task::find($taskId);
        if (!$task) {
            throw new ModelNotFoundException('the task with given id is not found');
        }
        $task->update([
            'status' => $newStatus
        ]);
        return $task;
    }

    /**
     * @param $note
     * @param $taskId
     * @return Task
     */
    public function addNoteToTask($note, $taskId)
    {
        $task = Task::find($taskId);
        if (!$task) {
            throw new ModelNotFoundException('the task with given id is not found');
        }
        $task->update([
            'note' => $note
        ]);
        return $task;
    }
}
