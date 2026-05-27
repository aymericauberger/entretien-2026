<?php

namespace App\Models;

use Database\Factories\ImportFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    /** @use HasFactory<ImportFactory> */
    use HasFactory;

    public const string STATUS_PENDING = 'pending';

    public const string STATUS_COMPLETED = 'completed';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'status',
    ];
}
