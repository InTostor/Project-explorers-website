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


<form style="display:none" id="payeer_form_real" method="post" action="https://payeer.com/merchant/">
    <input type="hidden" name="m_shop" value="<?=$m_shop?>">
    <input type="hidden" name="m_orderid" value="<?=$m_orderid?>">
    <input type="hidden" name="m_amount" value="<?=$m_amount?>">
    <input type="hidden" name="m_curr" value="<?=$m_curr?>">
    <input type="hidden" name="m_desc" value="<?=$m_desc?>">
    <input type="hidden" name="m_sign" value="<?=$sign?>">
    <input type="submit" name="m_process" value="send" />
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
                <div class="main__block__part">
                    <img width="100px" height="100px" class="item__logo">
                    <form method="post" action="">
                        <input class="field__nick" type="text" placeholder=" Ник" name="name">
                        <p><input class="button__submit" type="submit" name="submit" value="Купить за 19р."></p>

                    </form>
                </div>"
                <div class="item__info">
                    <h1 class="item__name">Какой-то заголовок</h1>
                    <p class="item__description">Много или не очень много текста, рассказывающего о сервере. А тут
                        начинается
                        проверка переносов строки
                        <?php
                        include ('../shop/items-description/blank-item.txt');
                    ?></p>


                </div>

            </div>

        </div>



    </div>







</body>
<?php
include ('../../../common/footer.html');
?>