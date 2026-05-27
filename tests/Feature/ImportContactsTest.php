<?php

namespace Tests\Feature;

use App\Domain\Imports\CloneContactService;
use App\Domain\Imports\FileService;
use App\Domain\Imports\ImportContacts;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImportContactsTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_imports_contacts_from_the_file_service(): void
    {
        $job = new ImportContacts;

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
    }

    public function test_it_updates_existing_contacts_by_email(): void
    {
        $job = new ImportContacts;

        $job->handle(new FileService, new CloneContactService);
        $job->handle(new FileService, new CloneContactService);

        $this->assertDatabaseCount('contacts', 2);
    }
}
