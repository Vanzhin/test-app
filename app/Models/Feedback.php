<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends BaseModel
{
    use HasFactory;
    protected $table = 'feedbacks';

    protected $fillable = [
        'nickName',
        'message',
    ];
    public static array $columnsToGet = [
        'nickName',
        'message',

    ];
}
