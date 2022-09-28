<?php

namespace App\Core\Application\Service\CreateTask;

use App\Core\Domain\Models\Task\Task;
use App\Core\Domain\Repository\TaskRepositoryInterface;
use Exception;

class CreateTaskService
{
    private TaskRepositoryInterface $task_repository;

    /**
     * @param TaskRepositoryInterface $Task_repository
     */
    public function __construct(TaskRepositoryInterface $task_repository)
    {
        $this->task_repository = $task_repository;
    }

    /**
     * @throws Exception
     */
    public function execute(CreateTaskRequest $request)
    {
        $task = Task::create(
            $request->getTask(),
            $request->getDateTime(),
            $request->getReminder()
        );
        $this->task_repository->persist($task);
    }
}
