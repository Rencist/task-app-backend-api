<?php

namespace App\Core\Application\Service\CreateTask;

class CreateTaskRequest
{
    private string $task;
    private string $date_time;
    private bool $reminder;

    /**
     * @param string $task
     * @param string $date_time
     * @param bool $reminder
     */
    public function __construct(string $task, string $date_time, bool $reminder)
    {
        $this->task = $task;
        $this->date_time = $date_time;
        $this->reminder = $reminder;
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
}
