<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginTest extends TestCase
{

    /** @test */
    public function can_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'password' => Hash::make('@password123')
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => '@password123',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['message', 'user', 'token'])
                 ->assertJson(['message' => 'Login successful']);
    }

    /** @test */
    public function returns_401_for_invalid_credentials()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => '123',
        ]);

        $response->assertStatus(401)
                 ->assertJson(['message' => 'Invalid credentials']);
    }

    /** @test */
    public function returns_validation_error_for_missing_fields()
    {
        $response = $this->postJson('/api/login', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['email', 'password']);
    }
}
