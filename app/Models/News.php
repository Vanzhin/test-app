<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class News extends BaseModel
{
    use HasFactory;

    protected  $table = 'news';
    public static array $columnsToGet = [
        'news.id',
        'news.title',
        'news.author',
        'news.image',
        'news.description',
        'news.created_at',

    ];


    public function getNewsByCategory(int $category_id) :object
    {
        $news =  DB::table($this->table)
            ->leftJoin('news_categories', $this->table . '.id', '=', 'news_categories.news_id')
            ->leftJoin('categories','news_categories.category_id', '=', 'categories.id')
            ->select('news.*', 'categories.title as category_title',
                'categories.id as category_id')
            ->where('categories.id', '=', $category_id)
            ->get();
        return $news;
    }
    public function getFieldsToCreate() :array
    {

//        TODO убрать костыль
        $allFields = $this->getAllFields();
        $fields = [];
        foreach ($allFields as $item){
            if($item === 'id' or $item === 'slug' or $item === 'created_at' or $item === 'updated_at'){
                continue;
            } else{
                $fields[] = $item;
            }
        }
        return $fields;
    }
}
