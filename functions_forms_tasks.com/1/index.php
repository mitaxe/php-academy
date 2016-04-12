<?php
include 'main.html';

if (isset($_POST['send'])) {

    if (isset($_POST['first_area']) && isset($_POST['second_area'])) {
        $first_area = $_POST['first_area'];
        $second_area = $_POST['second_area'];

        $common = getCommonWords($first_area, $second_area);

        print_r($common);

    } else {
        throw new Error(
            "Ошибка, поля не найдены"
        );
    }

}

function getCommonWords($a, $b)
{

    $pieces_a = explode(" ", $a);
    $pieces_b = explode(" ", $b);

    $arr = [];

    for ($i = 0; $i < count($pieces_a); $i++) {
        for ($j = 0; $j < count($pieces_b); $j++) {
            if ($pieces_a[$i] == $pieces_b[$j]) {
                $arr[] = $pieces_a[$i];
            }
        }
    }

    $result = array_unique($arr);

    return $result;
}