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
    $res = [];
    $count = 0;

    if(count($pieces_a) < $limit) {
        $limit = count($pieces_a);
    }

    usort($pieces_a, function ($a, $b) {
        return mb_strlen($b) - mb_strlen($a);
    });

    while ($limit > 0 ) {
        $res[] = $pieces_a[$count++];
        $limit--;
    }
    return $res;
}

