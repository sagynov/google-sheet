<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\SheetStatus;

class Sheet extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'status',
        'created_at',
        'updated_at',
    ];
    protected function casts(): array
    {
        return [
            'status' => SheetStatus::class,
        ];
    }
}
