<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Header extends Component
{
    public static array $menu = [
        'Новости' => 'news.index',
        'Категории' => 'categories.index',
        'Отзывы' => 'feedbacks.index',
//        'Запрос' => 'query.create',
        'Админка' => 'admin.index',

    ];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    static function getMenu()
    {
        return Header::$menu;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header');
    }
}
