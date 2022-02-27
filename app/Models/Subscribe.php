<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subscribe extends BaseModel
{
    use HasFactory;
    protected  $table = 'subscribes';
    protected $fillable = [
        'user_id',
        'email',
        'subject',
        'subject_id',
        'status',
    ];

}
