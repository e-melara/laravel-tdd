<?php

namespace Tests\Feature;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;

class CreateStatusTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function a_user_can_create_statues(): void
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->post(route('statuses.store'), ['body' => 'Mi primer status']);

        $this->assertDatabaseHas('statuses', [
            'body' => 'Mi primer status',
        ]);
    }
}
