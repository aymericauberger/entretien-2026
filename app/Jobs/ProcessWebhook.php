<?php

namespace App\Jobs;

use App\Services\CloneContactService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessWebhook implements ShouldQueue
{
    use Queueable;

    public function __construct(public array $payload) {}

    public function handle(CloneContactService $cloneService): void
    {
        $cloneService->clone($this->payload);
    }
}
