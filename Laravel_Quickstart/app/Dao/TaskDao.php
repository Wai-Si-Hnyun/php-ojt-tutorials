<?php

namespace App\Dao;

use App\Models\Task;
use App\Contracts\Dao\TaskDaoInterface;

class TaskDao implements TaskDaoInterface
{
    /**
     * Get all tasks
     *
     * @return object
     */
    public function getTasks(): object
    {
        return Task::orderBy('id', 'desc')->get();
    }

    /**
     * Create task
     *
     * @param array $data
     * @return void
     */
    public function createTask(array $data): void
    {
        Task::create($data);
    }

    /**
     * Delete task by id
     *
     * @param integer $id
     * @return void
     */
    public function deleteTask(int $id): void
    {
        $task = Task::findOrFail($id);
        $task->delete();
    }
}