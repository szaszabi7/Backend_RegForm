<?php

$userHiba = false;
$userHibaUzenet = '';
$emailHiba = false;
$emailHibaUzenet = '';
$jelszoHiba = false;
$jelszoHibaUzenet = '';
$sikeresReg = false;
$sikeresRegisztracioUzenet = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['username'])) {
        $userHiba = true;
        $userHibaUzenet = "Nem adtál meg nevet";
    } elseif (strlen($_POST['username']) < 3) {
        $userHiba = true;
        $userHibaUzenet = "A felhasználónévnek legalább 3 karakternek kell lennie";
    }
    elseif (strtolower($_POST['username']) == 'admin') {
        $userHiba = true;
        $userHibaUzenet = "A név nem lehet " . $_POST['username'];
        $username = "";
    }
    else {
        $username = htmlspecialchars($_POST['username'], ENT_QUOTES);
    }

    if (empty($_POST['email'])) {
        $emailHiba = true;
        $emailHibaUzenet = "Nem adtál meg e-mail címet";
    } elseif (mb_strpos($_POST['email'], ".") === false) {
        $userHiba = true;
        $emailHibaUzenet = "Nem megfelelő az email cím formátuma";
        $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
    }
    else {
        $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
    }

    if (empty($_POST['password'])) {
        $jelszoHiba = true;
        $jelszoHibaUzenet = "Nem adtál meg jelszót";
        $password = '';
        $password2 = '';
    } elseif (strlen($_POST['password']) < 8) {
        $jelszoHiba = true;
        $jelszoHibaUzenet = "A jelszónak legalább 8 karakternek kell lennie";
        $password = '';
        $password2 = '';
    }
    else if ($_POST['password'] !== $_POST['password2']) {
        $jelszoHiba = true;
        $jelszoHibaUzenet = "A két jelszó nem egyezik meg";
    }
    else {
        $password = htmlspecialchars($_POST['password'], ENT_QUOTES);
        $password2 = htmlspecialchars($_POST['password2'], ENT_QUOTES);
    }

    if (!$userHiba && !$emailHiba && !$jelszoHiba) {
     $sikeresRegisztracioUzenet = 'Sikeres regisztráció!';
     $sikeresReg = true;
    }
    else $username = $email = $password = $password2 = "";
}

?><!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Regisztráció</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
</head>
<body>
    <?php if (!$sikeresReg) {?>
    <form method="POST">
        <div>
            <label>
                Usernév:<br>
                <input type='text' name='username' value="<?php echo isset($_POST["username"]) ? $_POST["username"] : ''; ?>">
            </label>
            <div class='errormessage'><?php echo $userHibaUzenet; ?></div>
        </div>
        <div>
            <label>
                Email cím:<br>
                <input type='email' name='email' value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>">
            </label>
            <div class='errormessage'><?php echo $emailHibaUzenet; ?></div>
        </div>
        <div>
            <label>
                Jelszó:<br>
                <input type='password' name='password'>
            </label>
            <div class='errormessage'><?php echo $jelszoHibaUzenet; ?></div>
        </div>
        <div>
            <label>
                Jelszó még egyszer:<br>
                <input type='password' name='password2'>
            </label>
        </div>
        <div>
            <input type='submit' value='Regisztráció'>
        </div>
    </form>
    <?php } else { ?>
    <p class='success'><?php echo $sikeresRegisztracioUzenet; ?></p>
    <?php } ?>
</body>
</html>
