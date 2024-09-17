<?php

namespace App\Services;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllUser()
    {
        return User::all();
    }

    /**
     * @param array $data
     * @return User
     */
    public function createUser(array $data)
    {
        return User::create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @return User
     */
    public function UpdateUser(array $data, $id)
    {
        $user = User::find($id);
        if (!$user) {
            throw new ModelNotFoundException('The user with the given ID was not found.');
        }
        $user->update($data);
        return $user;
    }

    /**
     * @param $id
     */
    public function deleteUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            throw new ModelNotFoundException('The user with the given ID was not found.');
        }
        $user->delete();
    }
    // get all project for auth user

    /**
     * @return Project
     */
    public function getUserProjects() {
        $user=Auth::user();
        return $user->projects;
    }
    //  get all tasks of project for auth user

    /**
     * @param $projectId
     * @return Task
     */
    public function getProjectTasks($projectId)
    {
        $user = User::find(Auth::id());
        return $user->tasks()->whereRelation('projectUser', 'project_id', $projectId)->get();
    }
}
