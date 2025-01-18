<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
{
    // Create a user with a known password and email
    $user = User::factory()->create([
        'username' => 'testuser',
        'email' => 'testuser@example.com',
        'password' => bcrypt('password'), 
    ]);

    // Attempt to log in with the username and password
    $response = $this->post('/login', [
        'username' => 'testuser', 
        'password' => 'password', 
    ]);

    // Check if the user is authenticated as the created user
    $this->assertAuthenticatedAs($user);

    // Assert the user is redirected to the 'home' route
    $response->assertRedirect(route('home'));
}


    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'username' => $user->username,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
