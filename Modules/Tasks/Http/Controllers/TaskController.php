<?php

namespace Modules\Tasks\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Tasks\Services\TaskService;
use Modules\Tasks\Http\Requests\StoreTaskRequest;
use Modules\Tasks\Http\Requests\UpdateTaskRequest;
use Modules\Tasks\Http\Requests\SearchTaskRequest;
use Illuminate\Http\JsonResponse;




/**
 * @OA\Info(
 *     title="Task Management API",
 *     version="1.0.0",
 *     description="API for managing tasks with CRUD, filtering, pagination, and sorting",
 *     @OA\Contact(email="emanzidanelgmal@gmail.com")
 * )
 * @OA\SecurityScheme(
 *     securityScheme="sanctum",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */

class TaskController extends Controller
{
    protected $service;

    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/api/tasks",
     *     summary="List tasks",
     *     tags={"Tasks"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(name="status", in="query", @OA\Schema(type="string", enum={"pending", "in_progress", "done"})),
     *     @OA\Parameter(name="priority", in="query", @OA\Schema(type="string", enum={"low", "medium", "high"})),
     *     @OA\Parameter(name="due_date_start", in="query", @OA\Schema(type="string", format="date")),
     *     @OA\Parameter(name="due_date_end", in="query", @OA\Schema(type="string", format="date")),
     *     @OA\Parameter(name="sort", in="query", @OA\Schema(type="string", default="id")),
     *     @OA\Parameter(name="direction", in="query", @OA\Schema(type="string", default="asc")),
     *     @OA\Parameter(name="per_page", in="query", @OA\Schema(type="integer", default=10)),
     *     @OA\Response(response=200, description="Paginated tasks")
     * )
     */
    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['status', 'priority', 'due_date_start', 'due_date_end']);
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'asc');
        $perPage = $request->input('per_page', 10);

        $tasks = $this->service->getAll($request->user(), $filters, $sort, $direction, $perPage);
        return response()->json($tasks, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/tasks",
     *     summary="Create a task",
     *     tags={"Tasks"},
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             required={"title"},
     *             @OA\Property(property="title", type="string", example="New Task"),
     *             @OA\Property(property="description", type="string", example="Task description"),
     *             @OA\Property(property="status", type="string", enum={"pending", "in_progress", "done"}),
     *             @OA\Property(property="due_date", type="string", format="date", example="2025-10-30"),
     *             @OA\Property(property="priority", type="string", enum={"low", "medium", "high"})
     *         )
     *     ),
     *     @OA\Response(response=201, description="Task created"),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = $this->service->create($request->user(), $request->validated());
        return response()->json($task, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/tasks/{id}",
     *     summary="Get a task",
     *     tags={"Tasks"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Task details"),
     *     @OA\Response(response=403, description="Unauthorized"),
     *     @OA\Response(response=404, description="Task not found")
     * )
     */
    public function show(Request $request, $id): JsonResponse
    {
        $task = $this->service->getUserTasksById($request->user(), $id);
        return response()->json($task, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/tasks/{id}",
     *     summary="Update a task",
     *     tags={"Tasks"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="Updated Task"),
     *             @OA\Property(property="description", type="string", example="Updated description"),
     *             @OA\Property(property="status", type="string", enum={"pending", "in_progress", "done"}),
     *             @OA\Property(property="due_date", type="string", format="date", example="2025-10-30"),
     *             @OA\Property(property="priority", type="string", enum={"low", "medium", "high"})
     *         )
     *     ),
     *     @OA\Response(response=200, description="Task updated"),
     *     @OA\Response(response=403, description="Unauthorized"),
     *     @OA\Response(response=404, description="Task not found"),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function update(UpdateTaskRequest $request, $id): JsonResponse
    {
        $task = $this->service->update($request->user(), $id, $request->validated());
        return response()->json($task, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/tasks/{id}",
     *     summary="Delete a task",
     *     tags={"Tasks"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Task deleted successfully"),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=404, description="Task not found"),
     *     @OA\Response(response=403, description="Forbidden"),
     * )
     */
    public function destroy(Request $request, $id): JsonResponse
    {
        $this->service->delete($request->user(), $id);
        return response()->json(null, 204);
    }




    /**
     * @OA\Get(
     *     path="/api/search_tasks",
     *     summary="Search tasks",
     *     tags={"Tasks"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(name="query", in="query", required=true, @OA\Schema(type="string")),
     *     @OA\Parameter(name="per_page", in="query", @OA\Schema(type="integer", default=10)),
     *     @OA\Response(response=200, description="Paginated search results"),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function search_query(SearchTaskRequest $request): JsonResponse
    {
        $tasks = $this->service->search($request->user(), $request->validated()['query'], $request->validated()['per_page'] ?? 10);
        return response()->json($tasks, 200);
    }
}
