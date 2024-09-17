<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttachUserRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

/**
 * Class ProjectController
 * @package App\Http\Controllers
 */
class ProjectController extends Controller implements HasMiddleware
{
    /**
     * @var ProjectService
     */
    protected $projectService;

    /**
     * ProjectController constructor.
     * @param ProjectService $projectService
     */
    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware('Admin', only: ['store','update','destroy','attachUser']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = $this->projectService->getAll();
        return $this->sendResponse($projects, 'projects have been retrieved successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();
        $project = $this->projectService->createProjcet($validated);
        return $this->sendResponse($project, 'project created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($projectId)
    {
        try {
            $project = $this->projectService->showProject($projectId);
            return $this->sendResponse($project, 'project has been retrieved successfully');
        } catch (ModelNotFoundException $e) {
            return $this->sendError('failed retrieved', ['errors' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, $projectId)
    {
        try {
            $validated = $request->validated();
            $project = $this->projectService->updateProject($validated, $projectId);
            return $this->sendResponse($project, 'project has been updated successfully');
        } catch (ModelNotFoundException $e) {
            return $this->sendError('failed update', ['errors' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($projectId)
    {
        try {
            $this->projectService->deleteProject($projectId);
            return response()->json([
                'succuss' => 'true',
                'message' => 'project has been deleted successfully'
            ]);
        } catch (ModelNotFoundException $e) {
            return $this->sendError('failed deleted', ['errors' => $e->getMessage()]);
        }
    }
    //  add user to project

    /**
     * @param AttachUserRequest $request
     * @param $projectId
     * @return \Illuminate\Http\Response
     */
    public function attachUser(AttachUserRequest $request, $projectId)
    {
        $validated = $request->validated();
        $this->projectService->attachUser($validated, $projectId);
        return $this->sendResponse([], 'user has been added to project succussfully');
    }

    // get users  for the specified project

    /**
     * @param $projectId
     * @return \Illuminate\Http\Response
     */
    public function getProjectUsers($projectId)
    {
        $users = $this->projectService->getProjectUsers($projectId);
        return $this->sendResponse($users,'users for the specified project have been retrieved successfully .');
    }

// get tasks  for the specified user and project

    /**
     * @param $projectUserId
     * @return \Illuminate\Http\Response
     */
    public function getProjectUserTasks($projectUserId)
    {
        $tasks = $this->projectService->getProjectUserTasks($projectUserId);
        return $this->sendResponse($tasks,'Tasks for the specified user and project have been retrieved successfully .');
    }

    // get all tasks  for the specified project

    /**
     * @param Request $request
     * @param $projectId
     * @return \Illuminate\Http\Response
     */
    public function getProjectTasks(Request $request, $projectId)
    {
        $tasks = $this->projectService->getProjectTasks($request,$projectId);
        return $this->sendResponse($tasks,'Tasks for the specified project have been retrieved successfully .');
    }

    /**
     * @param $projectId
     * @return \Illuminate\Http\Response
     */
    public function getOldestTask($projectId){
        $task = $this->projectService->getOldestTask($projectId);
        return $this->sendResponse($task,'oldest task has been retrieved successfully');
    }

    /**
     * @param $projectId
     * @return \Illuminate\Http\Response
     */
    public function getLatestTask($projectId){
        $task = $this->projectService->getLatestTask($projectId);
        return $this->sendResponse($task,'latest task has been retrieved successfully');
    }

    /**
     * @param $projectId
     * @return \Illuminate\Http\Response
     */
    public function getHighPriorityTask($projectId){
        $task = $this->projectService->getHighPriorityTask($projectId);
        return $this->sendResponse($task,'High priority task has been retrieved successfully');
    }
}
