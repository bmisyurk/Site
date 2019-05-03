<?php
    session_start();
    include 'install.php';
    $logged = unserialize(file_get_contents('private/passwd'));
    foreach ($logged as $u) {
        $a = $_SESSION['loggued_on_user'];
        if (trim($u['login']) === $a &&
            (trim($u['rights']) === 'admin' || trim($u['rights']) === 'moderator')) {
                $right = $u['rights'];
            break ;
        }
    }
    unset($u);
?>
 <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>index.html</title>
        <link rel="stylesheet" type="text/css" href="rush.css">
    </head>
    <body>
    <div class="all_adm content">
        <div class="container">
            <h1 style="color:#474e5d">CRUD items | right : <?php echo $right?>
            </h1>
            <hr>
            <div class="row">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Img</th>
                        <th>Price</th>
                        <th>Categ</th>
                        <th>Color</th>
                        <th>Quantity</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $product = unserialize(file_get_contents('private/product'));
                    if ($_POST['Create'] === "Create" || $_POST['Update'] === "Update" || $_POST['Delete'] === "Delete") {
                        if ($_POST['Create'] === "Create") {
                            $product[] = array('id' => $_POST['id'],
                                'name' => $_POST['name'],
                                'img' => $_POST['img'],
                                'price' => $_POST['price'],
                                'categ' => $_POST['categ'],
                                'color' => $_POST['color'],
                                'quant' => $_POST['quant']
                            );
                        } else if ($_POST['Delete'] === "Delete") {
                            unset($product[$_POST['id'] - 1]);
                            $product = array_values($product);
                        } else if ($_POST['Update'] === "Update") {
                            $product[$_POST['id'] - 1]['id'] = $_POST['id'];
                            $product[$_POST['id'] - 1]['name'] = $_POST['name'];
                            $product[$_POST['id'] - 1]['img'] = $_POST['img'];
                            $product[$_POST['id'] - 1]['price'] = $_POST['price'];
                            $product[$_POST['id'] - 1]['categ'] = $_POST['categ'];
                            $product[$_POST['id'] - 1]['color'] = $_POST['color'];
                            $product[$_POST['id'] - 1]['quant'] = $_POST['quant'];
                        }
                        file_put_contents('private/product', serialize($product));
                        header('Location: adminka.php');
                    }

                    $i = 0;
                    foreach ($product as $row) {

                        echo '<tr>';
                        echo '<form action="adminka.php" method="POST">';
                        echo '<td><input type="number" class="in" placeholder="id" name="id" value="' . ++$i . '"></td>';
                        echo '<td><input type="text" class="in" placeholder="name" name="name" value="' . $row['name'] . '"></td>';
                        echo '<td><input type="text" class="in" placeholder="img" name="img" value="' . $row['img'] . '"></td>';
                        echo '<td><input type="number" class="in" placeholder="price" name="price" value="' . $row['price'] . '"></td>';
                        echo '<td><input type="text" class="in" placeholder="categ" name="categ" value="' . $row['categ'] . '"></td>';
                        echo '<td><input type="text" class="in" placeholder="color" name="color" value="' . $row['color'] . '"></td>';
                        echo '<td><input type="number" class="in" placeholder="quant" name="quant" value="' . $row['quant'] . '"></td>';
                        if($right === 'admin' || $right === 'moderator') echo '<td><input type="submit" class="up" name="Update" value="Update"></td>';
                        if($right === 'admin') echo '<td><input type="submit" class="del" name="Delete" value="Delete"></td>';
                        echo '</form>';
                        echo '</tr>';

                    }
                    unset($row);
                    echo '<tr>';
                    echo '<form action="adminka.php" method="POST">';
                    echo '<td><input type="number" class="in" placeholder="id" name="id" value="' . ++$i . '"></td>';
                    echo '<td><input type="text" class="in" placeholder="name" name="name" value=""></td>';
                    echo '<td><input type="text" class="in" placeholder="img" name="img" value=""></td>';
                    echo '<td><input type="number" class="in" placeholder="price" name="price" value=""></td>';
                    echo '<td><input type="text" class="in" placeholder="categ" name="categ" value=""></td>';
                    echo '<td><input type="text" class="in" placeholder="color" name="color" value=""></td>';
                    echo '<td><input type="number" class="in" placeholder="quant" name="quant" value=""></td>';
                    if($right === 'admin' || $right === 'moderator') echo '<td><input type="submit" name="Create" value="Create"></td>';
                    echo '</form>';
                    echo '</tr>';
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
<?php
if($right === 'admin') {
    ?>
    <div class="container">
        <h1 style="color:#474e5d">Users</h1>
        <hr>
        <div class="row">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Login</th>
                    <th>Passwd</th>
                    <th>Rights</th>
                </tr>
                </thead>
                <tbody>
                <?php

                $users = unserialize(file_get_contents('private/passwd'));
                if ($_POST['uCreate'] === "Create" || $_POST['uUpdate'] === "Update" || $_POST['uDelete'] === "Delete") {
                    if ($_POST['uCreate'] === "Create") {
                        $pass = hash('whirlpool', $_POST['passwd']);
                        $new_user = array(
                            'uid' => $_POST['uid'],
                            'uname' => $_POST['uname'],
                            'login' => $_POST['login'],
                            'passwd' => $pass,
                            'rights' => 'general');
                        $users[] = $new_user;

                    } else if ($_POST['uDelete'] === "Delete") {
                        unset($users[$_POST['uid'] - 1]);
                        $users = array_values($users);

                    } else if ($_POST['uUpdate'] === "Update") {
                        $pass = hash('whirlpool', $_POST['passwd']);
                        $users[$_POST['uid'] - 1]['uid'] = $_POST['uid'];
                        $users[$_POST['uid'] - 1]['uname'] = $_POST['uname'];
                        $users[$_POST['uid'] - 1]['login'] = $_POST['login'];
                        $users[$_POST['uid'] - 1]['passwd'] = $pass;
                        $users[$_POST['uid'] - 1]['rights'] = $_POST['rights'];
                        $users = array_values($users);
                    }
                    file_put_contents('private/passwd', serialize($users));
                    header('Location: adminka.php');
                }

                $i = 0;
                foreach ($users as $user) {
                    echo '<tr>';
                    echo '<form action="adminka.php" method="POST">';
                    echo '<td><input type="number" class="in" placeholder="uid" name="uid" value="' . ++$i . '"></td>';
                    echo '<td><input type="text" class="in" placeholder="uname" name="uname" value="' . $user['uname'] . '"></td>';
                    echo '<td><input type="text" class="in" placeholder="login" name="login" value="' . $user['login'] . '"></td>';
                    echo '<td><input type="password" class="in" placeholder="passwd" name="passwd" value="' . $user['passwd'] . '"></td>';
                    echo '<td><input type="text" class="in" placeholder="rights" name="rights" value="' . $user['rights'] . '"></td>';
                    echo '<td><input type="submit" class="up" name="uUpdate" value="Update"></td>';
                    echo '<td><input type="submit" class="del" name="uDelete" value="Delete"></td>';
                    echo '</form>';
                    echo '</tr>';

                }

                unset($user);

                echo '<tr>';
                echo '<form action="adminka.php" method="POST">';
                echo '<td><input type="number" class="in" placeholder="uid" name="uid" value="' . ++$i . '"></td>';
                echo '<td><input type="text" class="in" placeholder="uname" name="uname" value=""></td>';
                echo '<td><input type="text" class="in" placeholder="login" name="login" value=""></td>';
                echo '<td><input type="text" class="in" placeholder="passwd" name="passwd" value=""></td>';
                echo '<td><input type="text" class="in" placeholder="rights" name="rights" value=""></td>';
                echo '<td><input type="submit" name="uCreate" value="Create"></td>';
                echo '</form>';
                echo '</tr>';
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
}
if($right === 'admin' || $right === 'moderator') {
    ?>
    <div class="container">
        <h1 style="color:#474e5d">Orders</h1>
        <hr>
        <div class="row">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Usename</th>
                    <th>Totalcost</th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <form action="" method="">
                        <td><input type="number" class="in" placeholder="order id" name="oid" value="1"></td>
                        <td><input type="text" class="in" placeholder="user name" name="ouname" value="admin"></td>
                        <td><input type="text" class="in" placeholder="total cost" name="cost" value="1000$"></td>
                        <td><input type="submit" class="up" name="deliver" value="Delivered"></td>
                        <?php if($right === 'admin')?> <td><input type="submit" class="del" name="canc" value="Cancel"></td>
                    </form>
                </tr>
                <tr>
                    <form action="" method="">
                        <td><input type="number" class="in" placeholder="order id" name="oid" value=""></td>
                        <td><input type="text" class="in" placeholder="user name" name="ouname" value=""></td>
                        <td><input type="text" class="in" placeholder="total cost" name="cost" value=""></td>
                        <td><input type="submit" name="Create" value="Create"></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php
}
        ?>
    </div>
    </body>
 </html>