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

        $file->write(['name', 'email', 'phone']);

        Contact::chunk(500, function ($contact) use ($file) {
            $file->write([
                $contact->name,
                $contact->email,
                $contact->phone,
            ]);
        });

        $file->save();
    }
}
