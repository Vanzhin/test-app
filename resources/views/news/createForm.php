<h2>Создание новости</h2>
<div>
    <?php foreach ($news as $key => $item):?>
        <p>Поле: <?=$key?></p>
        <input type="text" name="<?=$key?>">
    <?php endforeach;?>
    <p>Поле для подробного описания новости: </p>
    <textarea name="full_description"
              rows="10" cols="50" >
    </textarea>
    <br>
    <br>
   <input type="submit" value="добавить новость" name="submit">

</div>

