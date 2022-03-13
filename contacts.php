<?php
include $_SERVER['DOCUMENT_ROOT'] . "/service/setting.php";
include $_SERVER['DOCUMENT_ROOT'] . "/service/base_lib.php";
include($root . '/common/header.php');

$json = file_get_contents(dirname(__FILE__) . "/contacts.json");
$array = json_decode($json, true);
$c1 = $array['1'];
$c2 = $array['2'];
$c3 = $array['3'];

$c1_img = 'src="/images/avatars/' . $array['1-ava'] . '.png"';
$c2_img = 'src="/images/avatars/' . $array['2-ava'] . '.png"';
$c3_img = 'src="/images/avatars/' . $array['3-ava'] . '.png"';

?>



<!DOCTYPE HTML>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <title>Контакты разработчиков</title>
    <meta name="description" content="Свяжитесь с нами если есть вопросы или предложения" />
    <link rel="stylesheet" href="/styles/common/common.css">
    <link rel="stylesheet" href="/styles/contacts.css">
</head>

<div class="bg"></div>
<div class="bg1"></div>

<body>



    <div class="container">
        <div class=filler id=about>
            <div class="body__text">
                <h1 class="intro__h1">О нас</h1>
                <h2 class="intro__h2"></h2>
                <h3 class="intro__h3">Кто мы, что делаем и зачем это все</h3>
            </div>

            <div class="info__inner">

                <div class="acryl text__block">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        <br><br>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </div>
                <div class="acryl text__block">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>

        </div>

        <div class="separator"></div>

        <div class=filler id=contacts>
            <div class="body__text">
                <h1 class="intro__h1">Наша команда</h1>
                <h2 class="intro__h2"></h2>
                <h3 class="intro__h3">Разработчики, дизайнеры, рекламщики, администраторы</h3>
            </div>
            <div class="row">

                <div class="contact">
                    <img <?php echo $c1_img ?> class="avatar" width="157" height="150">
                    <div class="contact__text">
                        <?php echo '<p class="contact__paragraph">' . $c1 . '</p>' ?>
                    </div>
                </div>
                <div class="contact">
                    <img <?php echo $c2_img ?> class="avatar" width="157" height="150">
                    <div class="contact__text">
                        <?php echo '<p class="contact__paragraph">' . $c2 . '</p>' ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="contact">
                    <img <?php echo $c3_img ?> class="avatar" width="157" height="150">
                    <div class="contact__text">
                        <?php echo '<p class="contact__paragraph">' . $c3 . '</p>' ?>
                    </div>
                </div>
            </div>

        </div>


    </div>







</body>
<?php
include($root . '/common/footer.html');
?>