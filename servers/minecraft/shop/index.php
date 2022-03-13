<?php
include $_SERVER['DOCUMENT_ROOT']."/service/setting.php";
include $_SERVER['DOCUMENT_ROOT']."/service/base_lib.php";
try{
$item = $_GET["item"];
$img_path="/images/items/".$item.".png";

$json = file_get_contents(dirname(__FILE__)."/items-description/".$item.".json");
$array=json_decode($json,true);
$cost=$array['cost'];
$item_name=$array['name'];
$desc=$array['description'];
$desc_header=$array['desc_header'];
} catch (Exception $e){
    echo $e->getMessage();
    echo  $error_no_item;

}

// отправка данных на payeer
if (isset($_POST['submit'])) {
if (!empty($_POST['name']) ) {
$m_orderid = '1'; // номер счета в системе учета мерчанта
$m_amount = number_format($cost, 2, '.', ''); // сумма счета с двумя знаками после точки
$nick = $_POST['name'];
$desc = $item_name."Ё". $nick;
$m_desc = base64_encode($desc); // описание счета, закодированное с помощью алгоритма base64
$arHash = array($m_shop, $m_orderid, $m_amount, $m_curr, $m_desc);// Добавляем доп. параметры, если вы их задали
if (isset($m_params)){
$arHash[] = $m_params;
}
$arHash[] = $m_key;// Добавляем секретный ключ
$sign = strtoupper(hash('sha256', implode(":", $arHash)));// Формируем подпись
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
            alert('Вы не ввели ник');
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
    <title><?php echo $item_name?></title>
    <meta name="description" content='<?php echo 'Поддержите проект, приобретите '.$item_name?>'>
    <link rel="stylesheet" href="/styles/common/common.css">
    <link rel="stylesheet" href="/styles/Minecraft/shop_item.css">


</head>
<div class="bg"></div>
<div class="bg1"></div>

<body>



    <div class="container">
        <div class="filler block1">
            <div class="body__text">
                <h1 class="intro__h1"><?php echo $array['header1']?></h1>
                <h2 class="intro__h2"><?php echo $array['header2']?></h2>
                <h3 class="intro__h3"><?php echo $array['header3']?></h3>
            </div>
            <div class="main__block">
                <div class="main__block__part">
                    <img src=<?php echo $img_path ?> width="100px" height="100px" class="item__logo">
                    <form method="post" action="">
                        <input class="field__nick" type="text" placeholder=" Ник" name="name">
                        <p><input class="button__submit" type="submit" name="submit"
                                value='<?php echo "поддержать на ".$cost ?>'></p>

                    </form>
                </div>
                <div class="item__info">
                    <h1 class="item__name"><?php echo $desc_header ?></h1>
                    <p class="item__description"> <?php echo "<br>".$desc;?> </p>


                </div>

            </div>

        </div>



    </div>







</body>
<?php
include ('../../../common/footer.html');
?>