<?php
    if (!file_exists('private')) {
        mkdir("../private");
    }
    if (!file_exists('private/product')) {
        file_put_contents('../private/product', null);
    }
    if (!file_exists('private/passwd')) {
        file_put_contents('private/passwd', null);
    }
?>