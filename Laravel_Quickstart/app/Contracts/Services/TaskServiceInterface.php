<?php

namespace App\Contracts\Services;

interface TaskServiceInterface
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
     * @param array $data
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