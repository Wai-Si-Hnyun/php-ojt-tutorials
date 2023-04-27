<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Contracts\Services\TaskServiceInterface;

class TaskController extends Controller
{
    /**
     * task interface
     */
    private $taskService;

    /**
     * Create a costructor for task controller
     *
     * @param \App\Contracts\Services\TaskServiceInterface $taskServiceInterface
     */
    public function __construct(TaskServiceInterface $taskServiceInterface)
    {
        $this->taskService = $taskServiceInterface;
    }

    /**
     * Show Task Dashboard
     * 
     *@return \Illuminate\View\View task dashboard
     */
    public function index()
    {
        $tasks = $this->taskService->getTasks();

        return view('tasks', ['tasks' => $tasks]);
    }

    /**
     * Store new task
     * 
     * @param  \App\Http\Requests\TaskRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TaskRequest $request)
    {
        $this->taskService->createTask($request->toArray());
        return redirect()->route('task.index');
    }

    /**
     * Delete task by id
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->taskService->deleteTask($id);

        return redirect()->route('task.index');
    }
}