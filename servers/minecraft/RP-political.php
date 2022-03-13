<?php
// connecting header
include('../../common/header.php');
?>



<!DOCTYPE HTML>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <title>Project Explorers. RP-сервер</title>
    <meta name="description" content="Сервер в майнкрафт с элементами политики, roleplay, продвинутой экономикой" />
    <link rel="stylesheet" href="/styles/common/common.css">
    <link rel="stylesheet" href="/styles/Minecraft/RP-political.css">


</head>
<div class="bg"></div>
<div class="bg1"></div>

<body>



    <div class="container">
        <div class="filler block1">
            <div class="body__text">
                <h1 class="intro__h1">Политическо-ролевой сервер</h1>
                <h2 class="intro__h2">Заголовок2</h2>
                <h3 class="intro__h3">Версия 1.18.2 (обновляется через 1-3 недели, после выхода новой версии) </h3>
            </div>
            <div class="main__block">
                <img width="100px" height="100px" class="server__logo">
                <div class="server__info">
                    <h1 class="server__name">Какой-то заголовок</h1>
                    <p class="server__description">Много или не очень много текста, рассказывающего о сервере. Тут идет
                        проверка переносов строки</p>
                </div>

            </div>

        </div>

        <div class="separator">f</div>

        <div class="filler block2">
            <div class="row">
                <a href="/servers/minecraft/shop.php" class="row__element ">
                    <div class="row__element__inner e1-1"></div> Магазин
                </a>

                <a href="/servers/minecraft/rules.php" class="row__element ">
                    <div class="row__element__inner e2-1"></div> Правила
                </a>


            </div>
            <div class="row">

                <a href="http://explorers.net.ru:8123/#" class="row__element ">
                    <div class="row__element__inner e1-2"></div> 3d карта
                </a>
                <a href="/servers/minecraft/faq.php" class="row__element ">
                    <div class="row__element__inner e2-2"></div> Частые вопросы
                </a>
                <a href="http://explorers.net.ru:8124/#" class="row__element ">
                    <div class="row__element__inner e3-2"></div> 2d карта
                </a>

            </div>



        </div>

    </div>







</body>
<?php
include('../../common/footer.html');
?>