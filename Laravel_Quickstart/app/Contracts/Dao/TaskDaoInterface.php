<?php

namespace App\Contracts\Dao;

interface TaskDaoInterface
{
    /**
     * Get all tasks
     *
     * @return object
     */
    public function getTasks(): object;

    /**
     * Create task
     * 
     * @param array
     * @return void
     */
    public function createTask(array $data): void;

    /**
     * Delete task by id
     *
     * @param integer $id
     * @return void
     */
    public function deleteTask(int $id): void;
}