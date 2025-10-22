<?php

namespace Modules\AuditLogs\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AuditLogs\Services\AuditLogService;
use Illuminate\Http\JsonResponse;

/**
 
 * @OA\Schema(
 *     schema="AuditLog",
 *     type="object",
 *     title="AuditLog",
 *     description="Audit log entry",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="action", type="string", enum={"create", "update", "delete"}, example="create"),
 *     @OA\Property(property="entity", type="string", example="task"),
 *     @OA\Property(property="entity_id", type="integer", example=1),
 *     @OA\Property(property="changes", type="object", nullable=true, example={"old": {"title": "Old Title"}, "new": {"title": "New Title"}}),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-10-21T08:22:00Z")
 * )
 */

class AuditLogController extends Controller
{
    protected $auditLogService;

    public function __construct(AuditLogService $auditLogService)
    {
        $this->auditLogService = $auditLogService;
    }

    /**
     * @OA\Get(
     *     path="/api/audit-logs",
     *     summary="List audit logs (admin only)",
     *     tags={"Audit Logs"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of logs per page",
     *         @OA\Schema(type="integer", default=10)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Paginated list of audit logs",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/AuditLog")),
     *             @OA\Property(property="links", type="object"),
     *             @OA\Property(property="meta", type="object")
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=403, description="Forbidden")
     * )
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $logs = $this->auditLogService->getAll($request->user(), $request->input('per_page', 10));
            return response()->json($logs, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }
}
