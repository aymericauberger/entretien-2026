<?php

namespace App\Services;

use App\Models\Contact;

class CloneContactService
{
    /**
     * @param  array{name: string, email: string, phone: string|null}  $contactData
     */
    public function clone(array $contactData): Contact
    {
        return Contact::query()->updateOrCreate(
            ['email' => $contactData['email']],
            [
                'name' => $contactData['name'],
                'phone' => $contactData['phone'],
            ],
        );
    }
}
