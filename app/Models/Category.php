<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Category extends BaseModel
{
    use HasFactory;
    protected $table = 'categories';

    protected $fillable = [
        'title',
        'description',
    ];
    public static array $columnsToGet = [
        'title',
        'description',

    ];
    public function news(): BelongsToMany
    {
        return $this->belongsToMany(News::class, 'news_categories',
            'category_id', 'news_id',
            'id', 'id'
        );
    }
}
