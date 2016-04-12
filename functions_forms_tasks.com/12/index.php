<?php
echo '<meta charset="utf-8">';

setlocale(LC_ALL, "Russian");

$str = "а васька слушает да ест. а воз и ныне там. а вы друзья как ни садитесь,
все в музыканты не годитесь. а король-то — голый.
а ларчик просто открывался.а там хоть трава не расти";

$result = reverse_sentence($str);
echo $result;
function reverse_sentence($str)
{
    $arr = explode(".", $str);
    $temp_arr = [];

    for($i = count($arr) -1; $i >= 0; $i-- ) {
        $temp_arr[] = $arr[$i];
    }

    $res = implode('. ', $temp_arr);

    return $res;
}
