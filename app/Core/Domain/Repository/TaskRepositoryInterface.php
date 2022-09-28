<?php

namespace App\Core\Domain\Repository;

use App\Core\Domain\Models\Task\Task;
use App\Core\Domain\Models\Task\TaskId;

interface TaskRepositoryInterface
{
    public function persist(Task $user): void;

    public function find(TaskId $id): ?Task;
}
