<?php

namespace App\Infrastrucutre\Repository;

use App\Core\Domain\Models\Task\Task;
use App\Core\Domain\Models\Task\TaskId;
use App\Core\Domain\Repository\TaskRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class SqlTaskRepository implements TaskRepositoryInterface
{
    public function persist(Task $task): void
    {
        DB::table('task')->upsert([
            'id' => $task->getId()->toString(),
            'task' => $task->getTask(),
            'date_time' => $task->getDateTime(),
            'reminder' => $task->getReminder()
        ], 'id');
    }

    /**
     * @throws Exception
     */
    public function find(TaskId $id): ?Task
    {
        $row = DB::table('task')->where('id', $id->toString())->first();

        if (!$row) return null;

        return $this->constructFromRow($row);
    }

    /**
     * @throws Exception
     */
    private function constructFromRow($row): Task
    {
        return new Task(
            new TaskId($row->id),
            $row->task,
            $row->date_time,
            $row->reminder
        );
    }
}
