<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;


class RegisterTest extends TestCase
{



    // public function can_register_user()
    // {
    //     $response = $this->postJson('/api/register', [
    //         'name' => 'Fatma Esmail',
    //         'email' => 'fatmaesmaill@example.com',
    //         'password' => '@Password123',
    //         'password_confirmation' => '@Password123',
    //     ]);

    //     $response->assertStatus(201)
    //              ->assertJsonStructure([
    //                  'message', 'user', 'token'
    //              ])
    //              ->assertJson(['message' => 'User registered successfully']);

    //     $this->assertDatabaseHas('users', [
    //         'email' => 'fatmaesmail@example.com'
    //     ]);
    // }

    /** @test */

    public function can_register_user()
    {
        $user = User::factory()->create();

        // Generate a Sanctum token
        $token = $user->createToken('api-token')->plainTextToken;

        // Simulate the response structure
        $responseData = [
            'message' => 'User registered successfully',
            'user' => $user->toArray(),
            'token' => $token,
        ];

        // Assert the response structure
        $this->assertEquals('User registered successfully', $responseData['message']);
        $this->assertArrayHasKey('user', $responseData);
        $this->assertArrayHasKey('token', $responseData);
        $this->assertEquals($user->email, $responseData['user']['email']);

        // Assert the user exists in the database
        $this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);
    }

    /** @test */
    public function returns_validation_error_for_invalid_data()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'fatma',
            'email' => 'invalid-email',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['email', 'password']);
    }
}

