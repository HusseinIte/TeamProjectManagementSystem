<?php

namespace App\Services;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class ProjectService
 * @package App\Services
 */
class ProjectService
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Project::all();
    }

    /**
     * @param array $data
     * @return Project
     */
    public function createProjcet(array $data)
    {
        return Project::create([
            'name' => $data['name'],
            'description' => $data['description']
        ]);
    }

    /**
     * @param $id
     * @return Project
     */
    public function showProject($id)
    {
        $project = Project::with('users')->find($id);
        if (!$project) {
            throw new ModelNotFoundException('the project with given id is not found');
        }
        return $project;
    }

    /**
     * @param array $data
     * @param $id
     * @return Project
     */
    public function updateProject(array $data, $id)
    {
        $project = Project::find($id);
        if (!$project) {
            throw new ModelNotFoundException('the project with given id is not found');
        }
        $project->update([
            'name' => $data['name'] ?? $project->name,
            'description' => $data['description'] ?? $project->description
        ]);
        $project->save();
        return $project;
    }

    /**
     * @param $id
     */
    public function deleteProject($id)
    {

        $project = Project::find($id);
        if (!$project) {
            throw new ModelNotFoundException('the project with given id is not found');
        }
        $project->delete();
    }

    // add user to project with additional data

    /**
     * @param array $data
     * @param $projectId
     */
    public function attachUser(array $data, $projectId)
    {
        $project = Project::find($projectId);
        $project->users()->attach($data['user_id'], [
            'role' => $data['role'],
            'contribution_hours' => $data['contribution_hours'] ?? 0.0
        ]);
    }
    // Get users contributing to the project

    /**
     * @param $projectId
     * @return User
     */
    public function getProjectUsers($projectId)
    {
        $project = Project::find($projectId);
        if (!$project) {
            throw new ModelNotFoundException('the project with given id is not found');
        }
        return $project->users;
    }
    // get tasks  for the specified user and project

    /**
     * @param $projectUserId
     * @return Task
     */
    public function getProjectUserTasks($projectUserId)
    {
        $projectUser = ProjectUser::find($projectUserId);
        if (!$projectUser) {
            throw new ModelNotFoundException('the project user with given id is not found');
        }
        return $projectUser->tasks;
    }
    //  get all tasks with filter for project

    /**
     * @param $request
     * @param $projectId
     * @return Task
     */
    public function getProjectTasks($request, $projectId)
    {
        $project = Project::find($projectId);
        if (!$project) {
            throw new ModelNotFoundException('the project with given id is not found');
        }
        $query = $project->tasks;
        if ($request->filled('priority')) {
            $query->where('priority', $request->input('priority'));
        }
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        return $query->get();
    }

    /**
     * @param $projectId
     * @return Task
     */
    public function getOldestTask($projectId)
    {
        $project = Project::find($projectId);
        return $project->oldestTask();
    }

    /**
     * @param $projectId
     * @return Task
     */
    public function getLatestTask($projectId)
    {
        $project = Project::find($projectId);
        return $project->latestTask();
    }

    /**
     * @param $projectId
     * @return Task
     */
    public function getHighPriorityTask($projectId)
    {
        $project = Project::find($projectId);
        return $project->HighPriorityTask();
    }
}
