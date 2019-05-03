<?php
/**
 * Created by PhpStorm.
 * User: nmaliare
 * Date: 1/12/19
 * Time: 5:52 PM
 */
    function errors(){
        echo "ERROR\n";
        header("Location: modif.html");
        exit(1);
    }

    if($_POST['login'] && $_POST['oldpw'] && $_POST['newpw'] && $_POST['submit'] === "OK" &&
        file_exists('../private') && file_exists('../private/passwd')) {

        $users = unserialize(file_get_contents('../private/passwd'));
        $oldpw = hash('whirlpool', $_POST['oldpw']);
        $newpw = hash('whirlpool', $_POST['newpw']);

        foreach ($users  as $key => $user){
            if ($user['login'] === $_POST['login'] && $oldpw === $user['passwd']) {
                if ($oldpw !== $newpw){
                    $users[$key]['passwd'] = $newpw;
                    file_put_contents('../private/passwd', serialize($users));
                    header("Location: index.html");
                    echo "OK\n";
                    exit();
                }else{
                    errors();
                }
            }
        }
        errors();
    }
    else{
        errors();
    }
?>