
<?php foreach ($newsList as $news):?>

    <a href="<?=route('news.show',['id' => $news['id']])?>">
        <h2><?=$news['title']?></h2>
    </a>
    <h3><?=$news['description']?></h3>
        <h4>Все новости категории: <?=$news['category_id']?></h4>

    <p><?=$news['author'] . " "?><?=$news['created_at']?></p>

    </div>
    <hr>
<?php endforeach;?>
