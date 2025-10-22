<?php
namespace Modules\AuditLogs\Services;

use Modules\AuditLogs\Models\AuditLog;
use Modules\AuditLogs\Repositories\AuditLogRepository;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AuditLogService
{
    protected $repository;

    public function __construct(AuditLogRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(User $user, int $perPage = 10): LengthAwarePaginator
    {
        if ($user->role !== 'admin') {
            abort(403, 'Forbidden');
        }
        return $this->repository->getAll($perPage);
    }


}
