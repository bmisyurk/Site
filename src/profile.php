<?php
    session_start();

    if (!($_SESSION['loggued_on_user'])){
        header("Location: index.php");
    }else if($_SESSION['loggued_on_user']){
        $users = unserialize(file_get_contents('private/passwd'));
        foreach ($users as $user) {
            $a = $_SESSION['loggued_on_user'];
            if (trim($user['login']) === $a &&
                (trim($user['rights']) === 'admin' || trim($user['rights']) === 'moderator')) {
                header("Location: adminka.php");
                break ;
            } else {
                header("Location: modif.html");
                break ;
            }
        }
    }
?>