<?php foreach ($newsList as $news):?>
        <a href="<?=route('news.show',['id' => $news['id']])?>">
            <h2><?=$news['title']?></h2>
        </a>
        <h3><?=$news['description']?></h3>

        <a href="<?=route('news.categories.show', ['category_id' => $news['category_id']])?>">
            <h4>Все новости категории: <?=$news['category_id']?></h4>
        </a>

        <p><?=$news['author'] . " "?><?=$news['created_at']?></p>

    </div>
<hr>

<?php endforeach;?>
