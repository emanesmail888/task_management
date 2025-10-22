<?php
namespace Modules\Tasks\Repositories;

use Modules\Tasks\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TaskRepository
{
    public function query(): Builder
    {
        return Task::query();
    }

    public function create(array $data): Task
    {
        return Task::create($data);
    }

    public function update(Task $task, array $data): bool
    {
        return $task->update($data);
    }

    public function delete(Task $task): bool
    {
        return $task->delete();
    }

    public function applyFilters(Builder $query, array $filters): Builder
    {
        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (isset($filters['priority'])) {
            $query->where('priority', $filters['priority']);
        }
        if (isset($filters['due_date_start'])) {
            $query->where('due_date', '>=', $filters['due_date_start']);
        }
        if (isset($filters['due_date_end'])) {
            $query->where('due_date', '<=', $filters['due_date_end']);
        }
        return $query;
    }

    public function getPaginated(Builder $query, string $sort, string $direction, int $perPage): LengthAwarePaginator
    {
        return $query->orderBy($sort, $direction)->paginate($perPage);
    }


    public function search(string $query, int $perPage = 10): LengthAwarePaginator
    {
        return $this->query()->whereFullText(['title', 'description'], $query)->paginate($perPage);
    }

    // public function search(string $query, int $perPage = 10) {

    //     return $this->query()::where('title', 'like', "%$query%")
    //             ->orWhere('description', 'like', "%$query%")
    //             ->paginate($perPage);

    // }
}
