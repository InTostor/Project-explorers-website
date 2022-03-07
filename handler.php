<?php
include $_SERVER['DOCUMENT_ROOT']."/service/setting.php";
include $_SERVER['DOCUMENT_ROOT']."/service/base_lib.php";
require $_SERVER['DOCUMENT_ROOT']."/service/RCON.php";
use Thedudeguy\Rcon;
//   Отклоняем   запросы с   IP-адресов, которые   не принадлежат Payeer



if   (!in_array($_SERVER['REMOTE_ADDR'],   array('185.71.65.92', '185.71.65.189','149.202.17.210','192.168.0.186','192.168.0.150','127.0.0.1')))   return;
if  (isset($_POST['m_operation_id'])   && isset($_POST['m_sign'])) {
    $m_key   = '65Wq0ArVSWnys1K4';  
    //   Формируем   массив для генерации подписи


    
    $arHash   = 
    array($_POST['m_operation_id'],
    $_POST['m_operation_ps'],
    $_POST['m_operation_date'],
    $_POST['m_operation_pay_date'],
    $_POST['m_shop'],
    $_POST['m_orderid'],
    $_POST['m_amount'],
    $_POST['m_curr'],
    $_POST['m_desc'],
    $_POST['m_status']);  
    //   Если были переданы дополнительные параметры, то добавляем их в массив
    if   (isset($_POST['m_params']))
    {
        $arHash[]   = $_POST['m_params'];
    }  
    //   Добавляем в массив секретный ключ
    $arHash[]   = $m_key;
    //   Формируем подпись
    $sign_hash   = strtoupper(hash('sha256',   implode(':', $arHash)));  
    //   Если подписи совпадают и статус платежа "Выполнен"



    if   ($_POST['m_sign']   == $sign_hash &&   $_POST['m_status'] ==   'success')
    {  
        $order_desc = $_POST['m_desc'];
        $order_desc = base64_decode($order_desc);
        $order_desc_array = str_split($order_desc);
        $privilegy = $order_desc_array[1];

        $args=explode("Ё",$order_desc);
        $nickname = $args[0];


        $rcon = new Rcon($rcon_host, $rcon_port, $rcon_password, 1);

        if ($rcon->connect()){
         $rcon->sendCommand("lp user '$nickname' parent set '$args[1]'");
        }
        exit($_POST['m_orderid'].'|success');
    }      

    //   В противном случае возвращаем ошибку
    exit($_POST['m_orderid'].'|error');}