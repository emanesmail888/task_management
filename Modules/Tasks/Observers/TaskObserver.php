<?php

namespace Modules\Tasks\Observers;

use Modules\Tasks\Models\Task;
use Modules\AuditLogs\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class TaskObserver
{

    protected function log(string $action, Task $task, ?array $changes)
    {
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'entity' => 'task',
            'entity_id' => $task->id,
            'changes' => $changes ? json_encode($changes) : null,
        ]);
    }


    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        $this->log('create', $task, null);
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        $changes = $task->getDirty();
        $this->log('update', $task, $changes);
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        $this->log('delete', $task, null);
    }


}
