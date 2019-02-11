<?php
    session_start();
    $_SESSION['kart'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <title>Minimalist Store</title>
    <link href="store.css" rel="stylesheet">

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
                            echo '<li><a href="profile.php" class="signin">Cabinet</a></li>';
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
<!---------------------------------->
        <div>
            <div class="shop-item-toolbar">
                <div class="items-ordering">
                    <select name="orderby" class="orderby custom-select" title="order">
                        <option value="menu_order" selected="selected">Default sorting: by popularity</option>
                        <option value="price">Sort by price: low to high</option>
                        <option value="price-desc">Sort by price: high to low</option>
                    </select>
                </div>
                <form role="search" class="search">
                    <div class="input-group">
                        <input type="text" class="form_control search" placeholder="Search" name="search">
                        <div class="input_btn">
                            <button class="bbtn" type="submit">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <ul class="row products">
        <?php
            $product = unserialize(file_get_contents('private/product'));
            foreach ($product  as $item) {
                if ($_GET) {
                    if ($_GET['categ'] === $item['categ'] || $_GET['categ'] === $item['color']) {
                        echo '<li class="product">';
                        echo '<a href=""><img width="430" height="480" style="height: 33vw; width: 33vw; max-height: 351px" src="' . $item['img'] . '" alt="' . $item['name'] . '">';
                        echo '<h2>' . $item['name'] . '</h2>';
                        echo '<span class="price">';
                        echo '<span class="amount"><span class="currencySymbol">$</span>' . $item['price'] . '</span>';
                        echo "</span>";
                        echo "</a>";
                        echo '<a href="?add=' . $item['id'] . '" class="btn-bottom-line">Add to cart</a>';
                        echo "</li>";
                    }
                }if (!$_GET || $_GET['categ'] === 'all' || $_GET['add']){
                    echo '<li class="product">';
                    echo '<a href=""><img width="430" height="480" style="height: 33vw; width: 33vw; max-height: 351px" src="' . $item['img'] . '" alt="' . $item['name'] . '">';
                    echo '<h2>' . $item['name'] . '</h2>';
                    echo '<span class="price">';
                    echo '<span class="amount"><span class="currencySymbol">$</span>' . $item['price'] . '</span>';
                    echo "</span>";
                    echo "</a>";
                    echo '<a href="?add=' . $item['id'] . '" class="btn-bottom-line">Add to cart</a>';
                    echo "</li>";

                    if ($_GET['add'] === $item['id']) {
                        $i = -1;
                        $flag = 0;
                        while (++$i < count($_SESSION)){
                            if($_SESSION['kart'][$i]['id'] === $item['id']) {
                                $_SESSION['kart'][$i]['howmuch'] += 1;
                                $flag = 1;
                                break ;
                            }
                        }
                        if ($flag === 1){
                            header("Location: index.php");
                        }
                        else{
                            $add = array(
                                'id' => $item['id'],
                                'name' => $item['name'],
                                'img' => $item['img'],
                                'price' => $item['price'],
                                'quant' => $item['quant'],
                                'howmuch' => 1);
                            $_SESSION['kart'][] = $add;
                            header("Location: index.php");
                        }
                    }
                }
            }
                ?>

            </ul>
            <footer>
                <div style="min-width: 590px">
                    <p class="copy">© 2019 Rush00 nmaliare & bmisyurk</p>
                </div>
            </footer>
        </div>
</div>
</body>
</html>