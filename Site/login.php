<?php
    session_start();
    include 'auth.php';

    if ($_POST['login'] && $_POST['passwd']){
        $login = $_POST['login'];
        $passwd = $_POST['passwd'];
        if(auth($login, $passwd)){
            $_SESSION['loggued_on_user'] = $login;
            echo "OK\n";
            header('Location: index.php');
        }
    }
    if (!auth($login, $passwd)){
        $_SESSION['loggued_on_user'] = "";
        header('Location: 404.html');
    }
?>