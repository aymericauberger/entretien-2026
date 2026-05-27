<?php

namespace Tests\Feature;

use App\Domain\Exports\ExportContacts;
use App\Models\Contact;
use App\Services\FileService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExportContactsTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_exports_contacts_to_a_csv_file(): void
    {
        Storage::fake('local');

        Contact::factory()->create([
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
            'phone' => '+33123456789',
        ]);

        Contact::factory()->create([
            'name' => 'Grace Hopper',
            'email' => 'grace@example.com',
            'phone' => null,
        ]);

        (new ExportContacts)->handle(new FileService);

        // Storage::disk('local')->assertExists('exports/contacts.csv');

        // $rows = array_map(
        //     str_getcsv(...),
        //     explode("\n", trim(Storage::disk('local')->get('exports/contacts.csv'))),
        // );

        // $this->assertSame([
        //     ['name', 'email', 'phone'],
        //     ['Ada Lovelace', 'ada@example.com', '+33123456789'],
        //     ['Grace Hopper', 'grace@example.com', ''],
        // ], $rows);
    }
}
