<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolesAndPermissionsSeeder::class);

        $this->admin = User::factory()->create([
            'password' => Hash::make('Me_contrata@123'),
        ]);
        $this->admin->assignRole('admin');
    }

    public function test_it_is_listing_users()
    {
        $this->actingAs($this->admin, 'api');

        User::factory(5)->create();

        $response = $this->getJson('/api/users');

        $response->assertOk()->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name', 'email']
            ]
        ]);
    }

    public function test_it_is_creating_an_user()
    {
        $this->actingAs($this->admin, 'api');

        $payload = [
            'name' => 'Felipe Oliveira',
            'email' => 'felipe@aiqfome.com.br',
            'password' => 'Me_contrata_ai@123',
            'password_confirmation' => 'Me_contrata_ai@123',
            'type' => 'admin',
        ];

        $response = $this->postJson('/api/users', $payload);

        $response->assertStatus(201);

        $this->assertDatabaseHas('users', ['email' => $payload['email']]);
    }

    public function test_it_shows_a_user()
    {
        $this->actingAs($this->admin, 'api');

        $user = User::factory()->create();

        $response = $this->getJson("/api/users/{$this->admin->id}");

        $response->assertOk()->assertJson([
            'id' => $this->admin->id,
            'name' => $this->admin->name,
            'email' => $this->admin->email,
            'created_at' => $this->admin->created_at->toDateTimeString(),
        ]);
    }

    public function test_it_is_updating_an_user()
    {
        $this->actingAs($this->admin, 'api');

        $user = User::factory()->create();

        $payload = [
            'name' => 'Astolfo',
            'email' => 'astolfo@cliente.com',
        ];

        $response = $this->putJson("/api/users/{$user->id}", $payload);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', $payload);
    }

    public function test_it_is_deleting_an_user()
    {
        $this->actingAs($this->admin, 'api');

        $user = User::factory()->create();

        $response = $this->deleteJson("/api/users/{$user->id}");

        $response->assertNoContent();

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}