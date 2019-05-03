<?php
/**
 * Created by PhpStorm.
 * User: nmaliare
 * Date: 1/12/19
 * Time: 8:05 PM
 */
    session_start();
    $_SESSION['loggued_on_user'] = "";
    header("Location: index.html");
?>