<?php
echo '<meta charset="utf-8">';


$str = "а васька слушает да ест. а воз и ныне там. а вы друзья как ни садитесь,
все в музыканты не годитесь. а король-то — голый.
а ларчик просто открывался.а там хоть трава не расти";
$result = correct_sentence($str);
echo $result;

function correct_sentence($str)
{
    $arr = explode(".", $str);
    $res = '';
    for ($i = 0; $i < count($arr); $i++) {
        $arr[$i] = trim($arr[$i]);
        $arr[$i] = mb_ucfirst($arr[$i]);
        $res .= $arr[$i] . ". ";
    }
    return $res;

}

function mb_ucfirst($str)
{
    $fc = mb_strtoupper(mb_substr($str, 0, 1));
    return $fc . mb_substr($str, 1);
}