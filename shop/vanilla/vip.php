<?php

// Если нажата кнопка "Купить"

if (isset($_POST['submit'])) {

    // Если имя заполнено и выбран предмет

    if (!empty($_POST['name']) ) {
        $m_shop   = '1549179620';   // id мерчанта
        $m_orderid   = '1'; //   номер счета в системе учета мерчанта
        $m_amount   = number_format(19,   2, '.', ''); // сумма счета с двумя знаками после точки
        $m_curr   = 'RUB';   // валюта счета
        $nick = $_POST['name'];
        $desc = "1";
        $desc = $desc . $nick;
        $m_desc   = base64_encode($desc);   // описание счета, закодированное с помощью алгоритма base64
        $m_key   = '65Wq0ArVSWnys1K4';
        $arHash   = array($m_shop, $m_orderid, $m_amount, $m_curr, $m_desc);//   Добавляем доп. параметры, если вы их задали
        if (isset($m_params)){  
            $arHash[]   = $m_params;
        }
        //   Добавляем   секретный ключ
        $arHash[]   = $m_key;
        //   Формируем подпись
        $sign   = strtoupper(hash('sha256',   implode(":", $arHash)));
        ?>


        <form style="display:none" id="payeer_form_real" method="post"   action="https://payeer.com/merchant/">
            <input   type="hidden"   name="m_shop" value="<?=$m_shop?>">
            <input   type="hidden"   name="m_orderid"   value="<?=$m_orderid?>">
            <input   type="hidden"   name="m_amount"   value="<?=$m_amount?>">
            <input   type="hidden"   name="m_curr" value="<?=$m_curr?>">
            <input   type="hidden"   name="m_desc" value="<?=$m_desc?>">
            <input   type="hidden"   name="m_sign" value="<?=$sign?>">
            <input   type="submit"   name="m_process"   value="send" />
        </form>


<script type="text/javascript">

document.getElementById('payeer_form_real').submit();

</script>
        <?php
    }
    else
    {
        if (empty($_POST['name'])) {
            echo "<script>alert('Вы не ввели ник');</script>";
        }        
     }
}


?>

<!DOCTYPE HTML>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../styles/item.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="/images/logo.png" type="image/x-icon">
    <title> Project Explorers.Майнкрафт</title>
</head>

<header class="header">
    <div class="container">
        <div class="header__inner">

            <div class="header__logo"> <a class="header__logo" href="../../index.html"> Project Explorers</a></div>

            <nav class="nav">
                <a class="nav__link" href="../../about.html"> О нас</a>
                <a class="nav__link" href="../../projects.html"> Проекты</a>
                <a class="nav__link" href="../../shop.html">Магазин</a>
                <a class="nav__link" href="https://vk.com/projectexplorers"> Новости</a>
                <a class="nav__link" href="../../contacts.html"> Контакты</a>
            </nav>
        </div>
    </div>
</header>


<div class="intro">

    <div class="container">
        <h2 class="intro__title">Vip</h2>
        <div class="intro__inner">
            <div class="img_buy">
                <img src="../../images/items/vip.png" width="300" height="300">
                <form method="post" action="">
                    <input class="field__nick" type="text" placeholder=" Ник" name="name">
                    <p><input class="button__submit" type="submit" name="submit" value="Купить за 19р."></p>

                </form>
            </div>
            <div class="desc">
            <h1 class="description">Кол-во приватов - 3 </h1>
                <h1 class="description">Размеры приватов (объем блоков):1632000</h1>
                <h1 class="description">Количество домов /sethome: 3</h1>
                <h1 class="description">Число публичных варпов: 1</h1>
                <h1 class="description">Восстановление инвентаря после смерти: Нет</h1>
                <h1 class="description">Восстановление опыта после смерти: Нет</h1>
                <h1 class="description">Приватные слоты на сервере: Нет</h1>
                <h1 class="description">Смена префикса и его цвета: Нет</h1>
                <h1 class="description">Уникальная роль на нашем Discord сервере: Да</h1>
                <h1 class="description">Открыть верстак 3x3 - /workbench: Да</h1>
                <h1 class="description">Починка инструментов и оружия - /repair: Нет</h1>
                <h1 class="description">Надеть предмет на голову - /hat: Нет</h1>
                <h1 class="description">Вернуться на предыдущую позицию - /back: Нет</h1>
                <h1 class="description">Сменить время для себя - /ptime: Да</h1>
                <h1 class="description">Сменить погоду для себя - /pweather: Да</h1>
                <h1 class="description">Открыть эндер-сундук - /enderchest: Да</h1>
                <h1 class="description">Полёт - /fly: Нет</h1>
                <h1 class="description">Пополнить сытость - /feed: Нет</h1>
                <h1 class="description">Пополнить здоровье и сытость - /heal: Нет</h1>
                <h1 class="description">Режим бога - /god: Нет</h1>
                <h1 class="description">Посмотреть когда игрок был онлайн - /seen: Да</h1>
                <h1 class="description">Наборы предметов: VIP</h1>
            </div>
        </div>
    </div>
</div>






<footer class="footer">
    <div class="container">
        <div class=" footer__inner">
            <div class="footer__authors">
                <h1 class="authors">©2020-2022 Project Explorers Network     project-explorers-mc@outlook.com</h1>
            </div>
            <div class="footer__info">
                <nav class="footer__nav">
                    <a class="nav__link__footer" href="/law.html"> Юридическая информация</a>
                    <a class="nav__link__footer" href="/job.html"> Работа</a>
                    <a class="nav__link__footer" href="mailto:project-explorers-mc@outlook.com?subject=жалоба"> Пожаловаться</a>
                </nav>
            </div>
        </div>
    </div>
</footer>

</html>