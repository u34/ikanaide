<?php

// Este archivo es utilizado para registrar nuevos posts en la base de datos.

namespace App;

$fields = ['post-content', 'post', 'on-medium'];
if ($_POST && User::validateSession()) {
    // Comprobación de que el formulario no ha sido alterado mediante las herramientas de navegador.
    foreach($_POST as $key => $value) {
        if (!in_array($key, $fields)) {
            header('Location: /404');
            die();
        } else {
            if ($key === 'post-content') {
                $post['content'] = $value;
            } else if ($key === 'on-medium') {
                $post['relation'] = $value;
            }
        }
    }

    if (isset($_COOKIE['user_id']) && is_numeric($_COOKIE['user_id'])) {
        $post['user_id'] = intval($_COOKIE['user_id']);
    }

    if (isset($post['content']) && isset($post['user_id'])) {
        if (Activity::post($post)) {

            // Consigo el ID del último post introducido
            $post_id = DB::insertedId();

            // El formato es: Nombre de Anime (anime) ó Nombre de Manga (manga).
            // Mediante substr(), compruebo que los values de los option no han sido alterado mediante las herramientas de navegador.
            if (!empty($_POST['on-medium'])) {
                $medium = substr($post['relation'], -6, 5); // anime|manga
                if ($medium === 'anime' || $medium === 'manga') {
                    $entry = substr($post['relation'], 0, -8); // título de anime|manga
                    if ($entryId = Listing::exists($medium, $entry)) {
                        if (Activity::setPostRelation($medium, $post_id, $post['user_id'], $entryId)) {
                            header('Location: /' . $_COOKIE['username']);
                            die();
                        }
                    }
                }
            }
            if (isset($_COOKIE['username'])) {
                header('Location: /' . $_COOKIE['username']);
                die();
            } else {
                header('Location: /logout');
            }
            die();
        }
    }
} else {
    header('Location: /404');
}