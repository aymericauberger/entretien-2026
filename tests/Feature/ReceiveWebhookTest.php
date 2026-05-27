<?php

namespace Tests\Feature;

use App\Jobs\ProcessWebhook;
use App\Services\CloneContactService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class ReceiveWebhookTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_dispatches_a_webhook_job_with_the_request_content(): void
    {
        Queue::fake();

        $payload = [
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
            'phone' => '+33123456789',
        ];

        $this->postJson(route('webhooks.contacts'), $payload)
            ->assertStatus(202);

        Queue::assertPushed(
            ProcessWebhook::class,
            fn (ProcessWebhook $job): bool => $job->payload === $payload,
        );
    }

    public function test_process_webhook_imports_the_contact_from_the_payload(): void
    {
        $payload = [
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
            'phone' => '+33123456789',
        ];

        (new ProcessWebhook($payload))->handle(new CloneContactService);

        $this->assertDatabaseHas('contacts', $payload);
    }
}
