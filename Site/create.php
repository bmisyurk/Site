<?php
/**
 * Created by PhpStorm.
 * User: nmaliare
 * Date: 1/12/19
 * Time: 2:30 PM
 */
    function errors(){
        echo "ERROR\n";
        exit(1);
    }

    if($_POST['login'] && $_POST['passwd'] && $_POST['uname'] && $_POST['submit'] === "OK"){
        if (!file_exists('private')){
            mkdir('private');
        }
        if (!file_exists('private/passwd')){
           file_put_contents('private/passwd', null);
        }
        $users = unserialize(file_get_contents('private/passwd'));
        foreach ($users  as $user){
            if ($user['login'] == $_POST['login']){
                errors();
            }
        }
        $pass = hash('whirlpool', $_POST['passwd']);
        $new_user = array(
            'uid' => '9999',
            'login' => $_POST['login'],
            'uname' => $_POST['uname'],
            'passwd' => $pass,
            'rights' => 'general');

        $users[] = $new_user;
        file_put_contents('private/passwd', serialize($users));
        header("Location: index.html");
        echo "OK\n";
    }
    else{
        errors();
    }
?>