
# Task Management API

## Setup
1. Clone repo: `git clone <url>`
2. Install dependencies: `composer install`
3. Copy `.env.example` to `.env`: `cp .env.example .env`
4. Generate app key: `php artisan key:generate`
5. Run migrations and seeders: `php artisan migrate --seed`
6. Start server: `php artisan serve`
7. Generate Swagger docs: `php artisan l5-swagger:generate`

8 . MiddleWare :RoleMiddleware to control routes

## Module Structure
- **TasksModule**: Located in `Modules/TasksModule/`, contains all task-related logic:
  - `Controllers/TaskController.php`: Handles API requests.
  - `Services/TaskService.php`: Business logic.
  - `Repositories/TaskRepository.php`: Database queries.
  - `Models/Task.php`: Eloquent model.
  - `Requests/*`: Validation for CRUD and search.
  - `Observers/TaskObserver.php`: Audit logging.
  - `Notifications/*`: Logs notifications.

- **AuditLogsModule**: Located in `Modules/AuditLogsModule/`, contains all task-related logic:
  - `Controllers/AuditLogController.php`: Handles API requests.
  - `Services/AuditLogService.php`: Business logic.
  - `Repositories/AuditLogRepository.php`: Database queries.
  - `Models/AuditLog.php`: Eloquent model.
  - `Requests/*`: Validation for CRUD and search.


## Tests
-Auth :
      -RegisterTest
      -LoginTest
      -UserTest
      -LogoutTest
-Tasks:
     -test_user_can_create_task
     -test_user_can_read_own_task
     -test_user_cannot_access_others_task
     -test_admin_can_access_all_tasks
     -test_user_can_update_own_task
     -test_user_can_delete_own_task

-AuditLogs:
       -test_admin_can_access_audit_logs
       -test_non_admin_cannot_access_audit_logs


Run: `php artisan test --coverage`
- Tests located in `tests/Feature/` for Application.

## Authentication
- Register: `POST /api/register {name, email, password, password_confirmation}`
- Login: `POST /api/login {email, password}` → Returns token
- User: `GET /api/User ` → Returns User Data
- User: `POST /api/logout ` → Delete Access Token


- Use `Bearer <token>` in headers for protected routes.

## Endpoints
- **Tasks**: `GET/POST/PUT/DELETE /api/tasks`
- **audit-logs**: `GET /api/audit-logs`

- **Search**: `GET /api/search_tasks?query=term`
- **Docs**: `/api/documentation`
