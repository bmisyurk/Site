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
                        <span class="counter-shop-box"><?php echo count($_SESSION['kart']); ?></span>
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
                    <div class="blocks blocks-tovar">Product</div>
                    <div class="blocks head_pr">Price</div>
                    <div class="price">QTY</div>
                </div>
                    <?php
                    if ($_GET['order'] === 'ok'){
                        if (!($_SESSION['loggued_on_user'])){
                            header('Location: index.html');
                        }
                        else{
                            unset($_SESSION['kart']);
                            header('Location: done.php');
                        }
                    }elseif ($_GET['order'] === 'ko'){
                        unset($_SESSION['kart']);
                        header('Location: index.php');
                    }
                    if ($_GET['plus']){
                        $_SESSION['kart'][$_GET['plus']-10]['howmuch'] += 1;
                    }
                    if ($_GET['minus']){
                        $_SESSION['kart'][$_GET['minus']-10]['howmuch'] -= 1;
                    }
                        $i = -1;
                        $total = 0;

                        while (++$i < count($_SESSION['kart'])){
                            echo '<div class ="image">';
                            echo '<img  src="'.$_SESSION['kart'][$i]['img'].'" width="150" height="300" align="left" >';
                            echo '<p class= "textbas">'.$_SESSION['kart'][$i]['name'].'</p>';
                            echo '<p class= "price">'.$_SESSION['kart'][$i]['price'].'</p>';
                            echo '<div class="blocks blocks-button basketstr">
                                        <a href="?minus=1'.$i.'" class="button button-minus">-</a>
                                        <input type="number" value="'.$_SESSION['kart'][$i]['howmuch'].'">
                                        <a href="?plus=1'.$i.'" class="button button-plus">+</a>
                                   </div>';
                            echo '</div>';
                            $total +=  ($_SESSION['kart'][$i]['price'] * $_SESSION['kart'][$i]['howmuch']);
                        }
                    ?>
                <div class="footertxt">
                    <div class="gorbas basketstr">
                        <div class="blocks">
                            <a href="?order=ko" style="color:#dfdfdf">| Clear cart |</a>
                        </div>
                        <div class="blocks">
                            <p>Total cost: <?php echo $total?> $</p>
                        </div>

                    </div>
                </div>
                <p class="buttond" style="text-align:center;">
                    <a href="?order=ok" target="_self" style="cursor: pointer; font-size:18px; text-decoration: none; padding:14px 61px; color:#dfdfdf; background-color: #3e3e40; border-radius:25px; border: 3px solid #3a3a3a;">
                        Place order</a>
                </p>
            </div>
        </div>
</div>