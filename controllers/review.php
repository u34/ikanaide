<?php

namespace App;

$reviewGuide = explode('/', $uri);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    if ($reviewGuide[3] === 'anime' || $reviewGuide[3] === 'manga') {
        $reviewMedium = $reviewGuide[3];
    }

    if (isset($reviewGuide[4])) {
        $fields = ['reviewTitle', 'reviewContent', 'submit'];
        if (Listing::exists($reviewMedium, str_replace('-', ' ', $reviewGuide[4]))) {
            $newReview['title'] = str_replace('-', ' ', $reviewGuide[4]);
        }
    } else {
        $fields = ['title', 'reviewTitle', 'reviewContent', 'submit'];
    }

    foreach ($_POST as $key => $value) {
        // Inspección de que los nombres de campo del formulario HTML no han sido modificados en las herramientas de navegador.
        if (!in_array($key, $fields)) {
            header('Location: /404');
            die();
        } else {
            // Validación y asignación de la información.
            if (!($key === 'submit')) {
                if (!empty($value)) {
                    switch ($key) {
                        case 'title':
                            if (Listing::exists($reviewMedium, str_replace('-', ' ', $value))) {
                                $newReview[$key] = str_replace('-', ' ', $value);
                                $ok = true;
                            }
                            break;
                        case 'reviewTitle':
                            if (strlen($value) <= 0 || strlen($value) > 50) {
                                $errorMessage = 'Title cannot be longer than 50 characters';
                            } else {
                                $newReview[$key] = $value;
                                $ok = true;
                            }
                            break;
                        case 'reviewContent':
                            $newReview[$key] = $value;
                            $ok = true;
                            break;
                    }
                } else {
                    $newReview = null;
                    header('Location: /404');
                    die();
                }
            }
        }
    }
    if ($ok) {
        Review::createReview($reviewMedium, $newReview);
    }
} else {
    if ($reviewGuide[1] === 'reviews') {
        $reviewsHome = Review::getReviews();
    } else if (($reviewGuide[1] === 'review' && is_numeric($reviewGuide[2])) && !isset($reviewGuide[3])) {
        $review_id = $reviewGuide[2];
        $review = Review::getReview($review_id);
        $reviewVotes = Review::getReviewVotes($review_id);
        if (User::validateSession()) {
            $userVote = Review::userVote($review_id, $_COOKIE['user_id']);
        }
    } else if (($reviewGuide[1] === 'review' && $reviewGuide[2] === 'new') && (isset($reviewGuide[3]) && !isset($reviewGuide[4]))) {
        if ($reviewGuide[3] === 'anime' || $reviewGuide[3] === 'manga') {
            $titles = Review::getTitles($reviewGuide[3]);
        }
    } else if (($reviewGuide[1] === 'review' && $reviewGuide[2] === 'new') && (isset($reviewGuide[3]) && isset($reviewGuide[4]))) {
        if ($reviewGuide[3] === 'anime' || $reviewGuide[3] === 'manga') {
            if (Listing::exists($reviewGuide[3], str_replace('-', ' ', $reviewGuide[4]))) {
                $entryToReview = str_replace('-', ' ', $reviewGuide[4]);
            } else {
                header('Location: /404');
                die();
            }
        }
    }

    if (isset($reviewsHome) || isset($review) || isset($titles) || isset($entryToReview)) {
        require view('reviews/review.view.php');
    } else {
        header('Location: /404');
        die();
    }
}