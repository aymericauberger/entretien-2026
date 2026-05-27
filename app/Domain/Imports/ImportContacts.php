<?php

namespace App\Domain\Imports;

use App\Models\Import;
use App\Services\CloneContactService;
use App\Services\FileService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ImportContacts implements ShouldQueue
{
    use Queueable;

    public function __construct(public int $importId) {}

    public function handle(FileService $files, CloneContactService $cloneService): void
    {
        $import = Import::query()->findOrFail($this->importId);

        foreach ($files->getLines($import) as $contactData) {
            $cloneService->clone($contactData);
        }

        $import->update([
            'status' => Import::STATUS_COMPLETED,
        ]);
    }
}
