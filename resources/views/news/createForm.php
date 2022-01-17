<h2>Создание новости</h2>
<div>
    <?php foreach ($news as $key => $item):?>
        <div>
            <p>Поле: <?=$key?></p>
            <input type="text" name="<?=$key?>">
        </div>

    <?php endforeach;?>
    <br>
   <input type="submit" value="добавить новость" name="submit">

</div>

