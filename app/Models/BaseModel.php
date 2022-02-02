<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BaseModel extends Model
{
    use HasFactory;
    public static function getAllFields($table) :array
    {
        $raw = DB::select("SHOW COLUMNS FROM {$table}");
        $fields = [];
        foreach ($raw as $item){
            $fields[] = $item->Field;
        }
        return $fields;
//         TODO не работает нормально, выдает поля отсортированные по алфавиту
//            Schema::getColumnListing($this->table);
    }
    public function getAll() :object
    {
        return DB::table($this->table)
            ->get();


    }
}
