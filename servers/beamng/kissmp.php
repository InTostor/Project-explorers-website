<?php
// connecting header
include ('../../common/header.php');
?>



<!DOCTYPE HTML>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <title>Project Explorers</title>
    <meta name="description" content="Проект серверов в майнкрафт, beamng.drive." />
    <link rel="stylesheet" href="/styles/common/common.css">
    <link rel="stylesheet" href="/styles/beamng/kissmp.css">


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
                <a href="#" class="row__element ">
                    <div class="row__element__inner e1-1"></div> Кнопка1
                </a>
                <a href="#" class="row__element ">
                    <div class="row__element__inner e1-2"></div> Кнопка2
                </a>
            </div>
            <div class="row">
                <a href="#" class="row__element ">
                    <div class="row__element__inner e2-1"></div> Кнопка3
                </a>
                <a href="#" class="row__element ">
                    <div class="row__element__inner e2-2"></div> Кнопка4
                </a>
            </div>



        </div>

    </div>







</body>
<?php
include ('../../common/footer.html');
?>