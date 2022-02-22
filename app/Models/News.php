<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class News extends BaseModel
{
    use HasFactory, Sluggable;

    protected  $table = 'news';
    public static array $columnsToGet = [
        'news.id',
        'news.title',
        'news.author',
        'news.image',
        'news.description',
        'news.created_at',

    ];
    protected $fillable = [
        'title',
        'author',
        'slug',
        'image',
        'description',
        'status',
    ];


    public function getFieldsToCreate() :array
    {

//        TODO убрать костыль
        $allFields = $this->getAllFields($this->table);
        $fields = [];
        // создаю массив с переводом заголовков столбцов БД
//        TODO убрать перевод в отдельный класс или сервис
        $translations = Config::get('constants.attributes');
        foreach ($allFields as $item){
            if($item === 'id' or $item === 'slug' or $item === 'created_at' or $item === 'updated_at'){
                continue;
            } else{
                if(array_key_exists($item, $translations)){
                    $fields[$item] = $translations[$item];

                }else{
                    $fields[$item] = $item;

                }
            }
        }
        return $fields;
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'news_categories',
            'news_id', 'category_id',
            'id', 'id'
        );
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
