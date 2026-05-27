<?php

namespace App\Domain\Imports;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ImportContacts implements ShouldQueue
{
    use Queueable;

    public function handle(FileService $files, CloneContactService $contacts): void
    {
        foreach ($files->contacts() as $contactData) {
            $contacts->clone($contactData);
        }
    }
}
