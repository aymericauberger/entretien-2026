<?php

namespace Tests\Feature;

use App\Domain\Imports\ImportContacts;
use App\Models\Import;
use App\Services\CloneContactService;
use App\Services\FileService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImportContactsTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_imports_contacts_from_the_file_service(): void
    {
        $import = Import::factory()->create();
        $job = new ImportContacts($import->id);

        $job->handle(new FileService, new CloneContactService);

        $this->assertDatabaseHas('contacts', [
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
            'phone' => '+33123456789',
        ]);

        $this->assertDatabaseHas('contacts', [
            'name' => 'Grace Hopper',
            'email' => 'grace@example.com',
            'phone' => null,
        ]);

        $this->assertDatabaseHas('imports', [
            'id' => $import->id,
            'status' => Import::STATUS_COMPLETED,
        ]);
    }
}
