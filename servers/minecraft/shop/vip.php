<?php
// connecting header
include ('../../../common/header.php');
?>



<!DOCTYPE HTML>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <title>Project Explorers</title>
    <meta name="description" content="Проект серверов в майнкрафт, beamng.drive." />
    <link rel="stylesheet" href="/styles/common/common.css">
    <link rel="stylesheet" href="/styles/Minecraft/shop_item.css">
    <style type="text/css">
    .item__logo{
        background-image: url("/images/items/vip.png");
    }

    </style>

</head>
<div class="bg"></div>
<div class="bg1"></div>

<body>



    <div class="container">
        <div class="filler block1">
            <div class="body__text">
                <h1 class="intro__h1">Заголовок1</h1>
                <h2 class="intro__h2">Заголовок2</h2>
                <h3 class="intro__h3">описание</h3>
            </div>
            <div class="main__block">
                <img width="100px" height="100px" class="item__logo">
                <div class="item__info">
                    <h1 class="item__name">Какой-то заголовок</h1>
                    <p class="item__description">Много или не очень много текста, рассказывающего о сервере. А тут
                        начинается
                        проверка переносов строки
                        <?php
                        include ('../shop/items-description/vip.txt');
                    ?></p>


                </div>

            </div>

        </div>



    </div>







</body>
<?php
include ('../../../common/footer.html');
?>