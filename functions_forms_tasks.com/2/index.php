<?php
include 'main.html';

if (isset($_POST['send'])) {

    if (isset($_POST['words'])) {

        $str = $_POST['words'];
        $top_3 = longest_words($str, 3);
        print_r($top_3);

    } else {
        throw new Error (
            "Error!"
        );
    }
}

function longest_words(string $a, int $limit)
{
    $pieces_a = explode(" ", $a);

    usort($pieces_a, function ($a, $b) {
        return mb_strlen($b) - mb_strlen($a);
    });

    $pieces_a = array_slice($pieces_a, 0, $limit);

    return $pieces_a;
}

