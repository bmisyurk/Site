<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <title>Minimalist Store</title>
    <link href="store.css" rel="stylesheet">
    <link href="cart.css" rel="stylesheet">

<body>
<!-- Header -->
<div class="container">
    <nav class="navbar navbar-toggleable-md padding5">
        <div class="full-width-container">
            <a class="brand" href="index.php">Minimalist Store</a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto">
                    <?php
                    if (!($_SESSION['loggued_on_user'])){
                        echo '<li><a href="index.html" class="signin">Sign in</a></li>';
                    }
                    else{
                        echo '<li><a href="" class="signin">Welcome: '.$_SESSION['loggued_on_user'].'!</a></li>';
                        echo '<li><a href="profile.php" class="signin">Go to profile</a></li>';
                        echo '<li><a href="logout.php" class="signin">Log out</a></li>';
                    }
                    ?>
                    <li><a class="dropdown-toggle" href="#" data-toggle="dropdown">Shop</a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Contacts</a>
                            <li class="current"><a href="#">Delivery</a></li>
                            <li><a href="#">Shop Single Product</a>
                        </ul>
                    </li>
                    <li><a class="dropdown-toggle" href="" data-toggle="dropdown">Categories</a>
                        <ul class="dropdown-menu">
                            <li><a href="?categ=all">All</a>
                            <li class="current"><a href="?categ=chair">Chair</a></li>
                            <li class="current"><a href="?categ=bed">Bed</a></li>
                            <li class="current"><a href="?categ=sofa">Sofa</a></li>
                            <li class="current"><a href="?categ=tables">Tables</a></li>
                            <li class="current"><a href="?categ=other">Other</a></li>
                            <hr>
                            <li class="current"><a href="?categ=Grey">Grey</a></li>
                            <li class="current"><a href="?categ=Mango">Mango</a></li>
                            <li class="current"><a href="?categ=Wood">Woodden</a></li>
                            <li class="current"><a href="?categ=White">White</a></li>
                            <li class="current"><a href="?categ=Black">Black</a></li>
                            <li class="current"><a href="?categ=Diff">Diff</a></li>
                        </ul>
                    </li>
                    <li><a href="kart.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i></a>
                        <span class="counter-shop-box">0</span>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="shop-item-toolbar">
        <h1>Shopping Cart</h1>
    </div>
    <div class="basket" style="min-width: 1000px">
        <div class="table">
            <div class="basketstr gorbas text">
                <h1>Thank you for order! Wait for a call!</h1>
            </div>
            <div class="footertxt">
                <div class="gorbas basketstr">
                    <div class="blocks"></div>
                    <div class="blocks"></div>
                </div>
            </div>
        </div>
    </div>
</div>
