<style type="text/css">
.error {
    position: fixed;
    top: 0px;
    left: 0px;
    display: block;
    min-width: 100vw;
    min-height: 100vh;
    background-color: white;
    z-index: 99999;
}
</style>




<?php 

$error_no_item='<div class="error">произошла ошибка при загрузке данных. Возможно этот предмет не существует. Если вы считаете что этот предмет существует/раньше открывался, то <a href=/contacts.php>свяжитесь с администрацией</a> <a href="/servers/minecraft/shop.php">Вернуться</a></div>';

function alert($string){
    echo "<script>alert('$string');</script>";
}

set_error_handler(
    function ($severity, $message, $file, $line) {
        throw new ErrorException($message, $severity, $severity, $file, $line);
    }
);