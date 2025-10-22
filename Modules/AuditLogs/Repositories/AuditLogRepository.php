<?php
namespace Modules\AuditLogs\Repositories;

use Modules\AuditLogs\Models\AuditLog;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AuditLogRepository
{

    public function getAll(int $perPage = 10): LengthAwarePaginator
    {
        return AuditLog::query()->paginate($perPage);
    }
    
}
