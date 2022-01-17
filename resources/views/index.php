<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Агрегатор новостей</title>
</head>
<body>
<div>
    <?php foreach ($menu as $key => $item):?>
        <a href="<?=$item?>"><?=$key?></a>
    <?php endforeach;?>
</div>
<hr>
<p>Точка сбора самых интересных и актуальных новостей российских онлайн-медиа. "Картина дня" формируется автоматически на базе популярности материалов у читателей, также используются данные обменной новостной сети. В проекте участвуют отобранные нами русскоязычные издания.</p>
</body>
</html>
