<?php

namespace App\Domain\Exports;

use App\Models\Contact;
use App\Services\FileService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ExportContacts implements ShouldQueue
{
    use Queueable;

    public function handle(FileService $file): void
    {
        $file->init();

        $file->write(['name', 'email', 'phone', 'tags']);

        Contact::query()
            ->orderByDesc('created_at')
            ->each(function ($contact) use ($file) {
                $file->write([
                    $contact->name,
                    $contact->email,
                    $contact->phone,
                    $contact->tags->pluck('name')->implode(', '),
                ]);
            }, 500);

        $file->save();
    }
}
