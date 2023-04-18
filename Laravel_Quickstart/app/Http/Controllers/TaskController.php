<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Http\Requests\TaskRequest;
use Illuminate\Validation\ValidationException;
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
     * @param TaskServiceInterface $taskServiceInterface
     */
    public function __construct(TaskServiceInterface $taskServiceInterface)
    {
        $this->taskService = $taskServiceInterface;
    }

    /**
     * Show Task Dashboard
     * 
     *@return View task dashboard
     */
    public function index()
    {
        $tasks = $this->taskService->getTasks();

        return view('tasks', ['tasks' => $tasks]);
    }

    /**
     * Store new task
     * 
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(TaskRequest $request)
    {
        try {
            
            $this->taskService->createTask($request->toArray());
            return redirect()->route('task.index');

        } catch (ValidationException $e) {

            return redirect()->route('task.index')->withInput()->withErrors($e->validator);

        }
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
