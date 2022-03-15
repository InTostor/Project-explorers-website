<?php
include $_SERVER['DOCUMENT_ROOT'] . "/service/setting.php";
include $_SERVER['DOCUMENT_ROOT'] . "/service/base_lib.php";
include($root . '/common/header.php');

$json = file_get_contents(dirname(__FILE__) . "/faq.json");
$array = json_decode($json, true);
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = 0;
}

$answer = $array[$id];

?>



<!DOCTYPE HTML>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <title>Частые вопросы</title>
    <meta name="description" content="Свяжитесь с нами если есть вопросы или предложения" />
    <link rel="stylesheet" href="/styles/common/common.css">
    <link rel="stylesheet" href="/styles/Minecraft/faq.css">
</head>




<div class="bg"></div>
<div class="bg1"></div>


<body>



    <div class="container">
        <div class="filler start"></div>
        <div class=filler>
            <div class="acryl body__text">
                <h1 class="intro__h1">Частые вопросы</h1>
                <h2 class="intro__h2"></h2>
                <h3 class="intro__h3">Кто мы, что делаем и зачем это все</h3>
            </div>
            <div class="questions">
                <a href="?id=how-to-communism" class="button1 acryl">
                    <div width="120px" height="120px" class="button1__logo"></div>
                    <p class="button1__text">Строительство коммунизма для чайников</p>
                </a>

                <a href="?id=earn-money" class="button1 acryl">
                    <div width="120px" height="120px" class="button1__logo"></div>
                    <p class="button1__text">Как заработать</p>
                </a>
                <a href="?id=town" class="button1 acryl">
                    <div width="120px" height="120px" class="button1__logo"></div>
                    <p class="button1__text">Все о городах (приваты)</p>
                </a>
                <a href="?id=town" class="button1 acryl">
                    <div width="120px" height="120px" class="button1__logo"></div>
                    <p class="button1__text">Как построить город</p>
                </a>



            </div>
        </div>
        <div class="separator"></div>

        <div class="filler answer__box">
            <div class="container">
                <?php echo '<p class="acryl">' . $answer . '</p>' ?>
            </div>
        </div>





    </div>

</body>
<?php
include($root . '/common/footer.html');
?>