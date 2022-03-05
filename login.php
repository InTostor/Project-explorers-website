
<?php

// Пример авторизаций через AuthMe на сайте / Example for authorization via AuthMe on website.
 
$mysql = array( // Настройка базы / DataBase configuration ===============
 
    "HOST" => "192.168.0.186",
    "USER" => "Admin",
    "PASS" => "ffq6KLHYY583MdEahTYe",
    "BASE" => "lac_db",
    "TABL" => "authme"
 
); // ===========================================

$con = mysqli_connect($mysql['HOST'], $mysql['USER'], $mysql['PASS'], $mysql['BASE']);

if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

function createSalt() {
    return substr(md5(uniqid(rand(), TRUE)), 0, 3); 
}

function testAccountExists($name) {
    global $con, $mysql;

    $query = mysqli_query($con, 'SELECT `id` FROM `'.$mysql['TABL'].'` where `username` = "'.mysqli_real_escape_string($con, $name).'"');
    $rowcount=mysqli_num_rows($query);
    if ($rowcount == 0 || $rowcount > 1 || 1 > $rowcount) {
        return false;
    }else{
        return true;
    }
}

function checkAccountPassword($name, $password) {
    global $con, $mysql;

    if (testAccountExists($name) == false) { return false; }

    $query = mysqli_query($con, 'SELECT `password` FROM `'.$mysql['TABL'].'` where `username` = "'.mysqli_real_escape_string($con, $name).'"');

    while ($row = mysqli_fetch_row($query))
    {
        $sha_info = explode('$', $row[0]);
        if( $sha_info[1] === "SHA" ) {
            $salt = $sha_info[0];
            $sha256_password = hash('sha256', $password);
            $sha256_password .= $sha_info[2];
            if( strcasecmp(trim($sha_info[3]),hash('sha256', $sha256_password) ) == 0 ){
                return true;
            } else {
                return false;
            }
        }
    }
}

function createHash($password) {
    $salt = createSalt();

    return '$SHA$' . $salt . '$' . hash('sha256', hash('sha256', $password) . $salt);
}

function registerAccount($name, $password, $regtime, $regip) {
    global $con, $mysql;

    if (testAccountExists($name) == true) { return false; }

    $sql = 'INSERT INTO `'.$mysql['TABL'].'`(`username`, `realname`, `password`, `ip`, `lastlogin`, `regdate`, `regip`) VALUES ("'.mysqli_real_escape_string($con, $name).'", "'.mysqli_real_escape_string($con, strtolower($name)).'", "'.createHash($password).'", "'.$regip.'", "'.$regtime.'", "'.$regtime.'", "'.$regip.'")';
    
    if (mysqli_query($con, $sql)) {
        return true;
    } else {
        return false;
    }
}


// Код формы / Code of form

if (!empty($_POST['itsAuth'])) {
    switch ($_POST['itsAuth']) {
        case '1': // Авторизация / Authorization

            if (!empty($_POST['login']) && !empty($_POST['password'])) {
                if (checkAccountPassword($_POST['login'], $_POST['password']) == true) {
                    echo "<div class='alert'>".$_POST['login'].", вы успешно вошли в аккаунт!</div>";
                } else {
                    echo "<div class='alert'>Неверный логин или пароль!</div>";
                }
            }

            break;
        
        case '2': // Регистрация / Register
            if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['password2'])) {
                if ($_POST['password'] == $_POST['password2']) {

                    // Тут нет проверки на валидность ника, и пароля (preg_match) / There is no check on the validity of the nickname, and the password (preg_match)
                    if (registerAccount($_POST['login'], $_POST['password'], time(), $_SERVER['REMOTE_ADDR']) == true) {
                        echo "<div class='alert'>Успешно!</div>";
                    } else {
                        echo "<div class='alert'>Данный аккаунт уже существует!</div>";
                    }
                } else {
                    echo "<div class='alert'>Пароли не совпадают!</div>";
                }
            }

            break;
    }

}


?>
<!DOCTYPE html>
<html>
<head>
<title>Эта страница еще в разработке!</title>
<meta charset="utf-8">
</head>
<body>

<style type="text/css">
    body{
        background-color: grey;
    }
    .block_form {
        display: inline-block;
        min-width: 100px;
        max-width: 300px;
        width: 100%;
        margin-left: 10px;
        margin-right: 10px;
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .form_wrap {
        display: block;
        width: 320px;
        margin-left: auto;
        margin-right: auto;
    }
    .center_text {
        text-align: center;
    }
    .wrapper {
        width: 100%;
        display: flex;
    }
    .block_header {
        height: 60px;
        background-color: brown;
        border-radius: 5px 5px 0px 0;
    }
    .block_header > h3 {
        line-height: 60px;
        color: white;
        font-weight: 700;
    }
    .block_content {
        background-color: #efbaba;
        padding-top: 10px;
        padding-bottom: 20px;
        padding-right: 10px;
        padding-left: 10px;
        border-radius: 0px 0px 5px 5px;
    }
    input[type=text], input[type=password] {
        height: 20px;
        padding: 5px;
        color: black;
        text-align: center;
        background-color: white;
        width: 100%;
        margin-bottom: 10px;
    }
    input[type=submit] {
        float: right;
        height: 40px;
    }
    .btn-secondary{
        float: right;
        background-color: brown;
    }
    .btn-secondary:hover{
        float: right;
        background-color: brown;
    }
    .alert {
        width: 300px;
        position: absolute;
        top: 5px;
        left: 5px;
        background-color: black;
        color: white;
        line-height: 40px;
        padding-left: 10px;
    }
    .title {
        padding-top: 30px;
        padding-bottom: 10px;
    }
    .title > h1 {
        text-align: center;
    }
</style>

<div class="wrapper">
    <div class="form_wrap">
        <div class="title">
            <h1>Эта страница еще в разработке!</h1>
        </div>
        <div class="block_form">
            <form method="POST">
                <div class="block_header">
                    <h3 class="center_text">Регистрация</h3> <!-- Registration -->
                </div>

                <div class="block_content">
                    <input type="text" name="login" placeholder="Ваш ник-нейм">
                    <input type="password" name="password" placeholder="Ваш пароль">
                    <input type="password" name="password2" placeholder="Повторите пароль">
                    

                    <input type="hidden" name="itsAuth" value="2">

                    <br>

                    <input type="submit" value="Регистрация"></input> <!-- Registration -->
                </div>

            </form>
        </div>

        <div class="block_form">
            <form method="POST">
                <div class="block_header">
                    <h3 class="center_text">Авторизация</h3> <!-- Authorization -->
                </div>

                <div class="block_content">
                    <input type="text" name="login" placeholder="Ваш ник-нейм">
                    <input type="password" name="password" placeholder="Ваш пароль">

                    <input type="hidden" name="itsAuth" value="1">

                    <br>

                    <input type="submit" value="Авторизация"></input> <!-- Authorization -->
                </div>

            </form>
        </div>

    </div>

</div>

</body>
</html>