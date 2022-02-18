<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resource extends BaseModel
{
    use HasFactory;
    protected $table = 'resources';

    protected $fillable = [
        'url',
        'description',
        'is_active'
    ];
    public static array $columnsToGet = [
        'url',
        'description',
        'is_active'

    ];
}
