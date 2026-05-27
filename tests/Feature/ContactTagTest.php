<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactTagTest extends TestCase
{
    use RefreshDatabase;

    public function test_contacts_belong_to_many_tags(): void
    {
        $contact = Contact::factory()->create();
        $tag = Tag::factory()->create([
            'name' => 'customer',
        ]);

        $contact->tags()->attach($tag);

        $this->assertTrue($contact->tags()->whereKey($tag->id)->exists());
        $this->assertTrue($tag->contacts()->whereKey($contact->id)->exists());

        $this->assertDatabaseHas('contact_tag', [
            'contact_id' => $contact->id,
            'tag_id' => $tag->id,
        ]);
    }
}
