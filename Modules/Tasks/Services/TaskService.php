<?php
namespace Modules\Tasks\Services;

use Modules\Tasks\Models\Task;
use Modules\Tasks\Repositories\TaskRepository;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Tasks\Notifications\TaskCreatedNotification;
use Modules\Tasks\Notifications\TaskCompletedNotification;

class TaskService
{
    protected $repository;

    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    protected function authorize(User $user, Task $task): void
    {
        if ($user->role !== 'admin' && $task->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }
    }

    public function getAll(User $user, array $filters = [], string $sort = 'id', string $direction = 'asc', int $perPage = 10): LengthAwarePaginator
    {
        $query = $this->repository->query();

        if ($user->role !== 'admin') {
            $query->where('user_id', $user->id);
        }

        $query = $this->repository->applyFilters($query, $filters);
        return $this->repository->getPaginated($query, $sort, $direction, $perPage);
    }

    public function create(User $user, array $data): Task
    {
        $data['user_id'] = $user->id;
        $task =$this->repository->create($data);
        // Notify The user with Task Created
        $user->notify(new TaskCreatedNotification($task));
        return $task;
    }

    public function getUserTasksById(User $user, int $id): Task
    {
        // $id = (int) $id;
        $task = $this->repository->query()->findOrFail($id);
        $this->authorize($user, $task);
        return $task;
    }

    public function update(User $user, int $id, array $data): Task
    {
        $task = $this->getUserTasksById($user, $id);
        $this->repository->update($task, $data);
        $task = $task->fresh();

        // if (isset($data['status']) && $data['status'] === 'done' && $task->status !== 'done') {

        if (isset($data['status']) && $data['status'] === 'done' ) {
            $task->user->notify(new TaskCompletedNotification($task));
        }

        return $task;



    }

    public function delete(User $user, int $id): bool
    {
        $task = $this->getUserTasksById($user, $id);
        return $this->repository->delete($task);
    }


    public function search(User $user, string $query, int $perPage): LengthAwarePaginator
    {
        $searchQuery = $this->repository->search($query, $perPage);
        if ($user->role !== 'admin') {
            $searchQuery->where('user_id', $user->id);
        }
        return $searchQuery;
    }


}
