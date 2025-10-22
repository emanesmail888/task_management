<?php
namespace App\Models;

/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     title="User",
 *     description="User model",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Eman Esmail"),
 *     @OA\Property(property="email", type="string", format="email", example="eman@example.com"),
 *     @OA\Property(property="role", type="string", enum={"user", "admin"}, example="user"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-10-21T08:22:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-10-21T08:22:00Z")
 * )
 */
class UserSchema
{
    // Empty class; used only for Swagger annotations
}
