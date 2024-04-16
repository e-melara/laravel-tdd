<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateStatusTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function guests_users_can_not_create_statuses()
    {
        $response = $this->postJson(route('statuses.store', ['body' => 'Mi primer status']));
        $response->assertRedirect('login');
    }

    #[Test]
    public function a_user_can_create_statues(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson(route('statuses.store'), ['body' => 'Mi primer status']);

        $response->assertJson([
            'body' => 'Mi primer status',
        ]);

        $this->assertDatabaseHas('statuses', [
            'body' => 'Mi primer status',
            'user_id' => $user->getAuthIdentifier(),
        ]);
    }

    #[Test]
    public function a_status_requires_a_body()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson(route('statuses.store'), ['body' => 'aa']);
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message', 'errors' => ['body'],
        ]);
    }
}
