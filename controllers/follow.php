<?php

namespace App;

if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $followingUser = $_COOKIE['user_id'];
    $followedUser = intval($_GET['id']);

    if (User::exists($followedUser)) {
        if (isset($_POST['follow']) && !(Following::isFollowing($followingUser, $followedUser))) {
            if (Following::follow($followingUser, $followedUser)) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                header('Location: /logout');
            }
            die();
        } else if (isset($_POST['unfollow']) && Following::isFollowing($followingUser, $followedUser)) {
            if (Following::unfollow($followingUser, $followedUser)) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                header('Location: /logout');
            }
            die();
        }
    }

}