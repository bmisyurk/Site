<?php
/**
 * Created by PhpStorm.
 * User: nmaliare
 * Date: 1/12/19
 * Time: 8:04 PM
 */
    function auth($login, $passwd){
        if (!$login || !$passwd)
            return FALSE;
        $users = unserialize(file_get_contents('private/passwd'));
        $pass = hash('whirlpool', $passwd);
        foreach ($users  as $key => $user){
            if ($user['login'] === $login && $pass === $user['passwd'])
                return TRUE;
        }
        return FALSE;
    }
?>