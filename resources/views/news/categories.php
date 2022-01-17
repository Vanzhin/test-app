<div>
    <h2>Список категорий</h2>
    <?php foreach ($categoryList as $category):?>
        <p>Идентификатор категории: <?=$category['id']?></p>
        <p>Название категории: <?=$category['title']?></p>
        <p>Дата создания категории: <?=$category['created_at']?></p>
    <hr>    


    <?php endforeach;?>
</div>
