<?php

namespace App\Core\Domain\Models\Task;

use Exception;
use App\Core\Domain\Models\Task\TaskId;

class Task
{
    private TaskId $task_id;
    private string $task;
    private string $date_time;
    private bool $reminder;

    /**
     * @param string $task
     * @param string $date_time
     * @param bool $reminder
     */
    public function __construct(TaskId $task_id, string $task, string $date_time, bool $reminder)
    {
        $this->task_id = $task_id;
        $this->task = $task;
        $this->date_time = $date_time;
        $this->reminder = $reminder;
    }


    /**
     * @return TaskId
     */
    public function getId(): TaskId
    {
        return $this->task_id;
    }

    /**
     * @return string
     */
    public function getTask(): string
    {
        return $this->task;
    }

    /**
     * @return string
     */
    public function getDateTime(): string
    {
        return $this->date_time;
    }

    /**
     * @return bool
     */
    public function getReminder(): bool
    {
        return $this->reminder;
    }

    /**
     * @throws Exception
     */
    public static function create(string $task, string $date_time, bool $reminder): self
    {
        return new self(
            TaskId::generate(),
            $task,
            $date_time,
            $reminder
        );
    }
}
