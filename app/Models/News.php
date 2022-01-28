<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class News extends BaseModel
{
    use HasFactory;

    protected  $table = 'news';
    private array $columnsToGet = [
        'news.id',
        'news.title',
        'news.author',
        'news.image',
        'news.description',
        'news.created_at',

    ];

    public function getAllNews()
    {
        $news =  DB::table($this->table)
            ->leftJoin('news_categories', $this->table . '.id', '=', 'news_categories.news_id')
            ->leftJoin('categories','news_categories.category_id', '=', 'categories.id')
            ->select('news.*', 'categories.title as category_title',
                'categories.id as category_id')
            ->orderBy('news.id')
            ->get();
        // у новостей может быть несколько категорий, поэтому поле category_id делаю массивом
        // с id категорий

        //TODO убрать костыль
        $ids = [];
        $categories = [];
        foreach ($news as $key => $item) {
            if(key_exists($item->id, $ids)){
                $ids[$item->id][] = $item->category_id;
                $categories[$item->id][] = $item->category_title;

                //удаляю элемент массива, если у него повторяется id категории. Чтобы не было дубликатов

                unset($news[$key - 1]);
            }else{
                $ids += [$item->id => [$item->category_id]];
                $categories += [$item->id => [$item->category_title]];

            }
            $item->category_id = $ids[$item->id];
            $item->category_title = $categories[$item->id];

        }

        return $news;
    }

    public function getOneNews(int $id)
    {
        return DB::table($this->table)
            ->find($id);
    }

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
