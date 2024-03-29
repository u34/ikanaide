<?php

namespace App;

if ((isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) && !empty($_POST['reason'])) {
    if (User::exists($_GET['id']) && User::validateSession()) {
        if ($_GET['id'] === $_COOKIE['user_id']) {
            exit('You cannot report yourself up.');
        }
        if (Report::report($_GET['id'], $_COOKIE['user_id'], $_POST['reason'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        } else {
            exit('Sorry, your report couldn\'t be submitted.');
        }
    } else {
       header('Location: /404');
       die();
    }
} else {
    header ('Location: /404');
}