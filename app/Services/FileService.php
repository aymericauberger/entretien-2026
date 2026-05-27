<?php

namespace App\Services;

use App\Models\Import;

class FileService
{
    public function getLines(Import $import): array
    {
        return [
            [
                'name' => 'Ada Lovelace',
                'email' => 'ada@example.com',
                'phone' => '+33123456789',
            ],
            [
                'name' => 'Grace Hopper',
                'email' => 'grace@example.com',
                'phone' => null,
            ],
        ];
    }
}
