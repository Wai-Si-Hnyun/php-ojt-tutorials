<?php

namespace App\Services;
use App\Contracts\Dao\TaskDaoInterface;
use App\Contracts\Services\TaskServiceInterface;

class TaskService implements TaskServiceInterface
{
    /**
     * task Dao
     */
    private $taskDao;

    public function __construct(TaskDaoInterface $taskDao)
    {
        $this->taskDao = $taskDao;
    }

    /**
     * Get all tasks
     *
     * @return object
     */
    public  function getTasks(): object
    {
        return $this->taskDao->getTasks();
    }

    /**
     * Create task
     *
     * @param array $data
     * @return void
     */
    public function createTask(array $data): void
    {
        $this->taskDao->createTask($data);
    }

    /**
     * Delete task by id
     *
     * @param integer $id
     * @return void
     */
    public function deleteTask(int $id): void
    {
        $this->taskDao->deleteTask($id);
    }
}