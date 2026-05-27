<?php

namespace App\Domain\Imports;

class FileService
{
    /**
     * @return array<int, array{name: string, email: string, phone: string|null}>
     */
    public function contacts(): array
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
