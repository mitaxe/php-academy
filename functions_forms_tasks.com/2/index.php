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

function longest_words(string $a, int $length)
{

    $pieces_a = explode(" ", $a);  // разбиваем строку на массив слов

    if (count($pieces_a) >= $length) {

        $count = 0; // количество найденых слов
        $result = [];

        while ($count < $length) {
            $temp = $pieces_a[0]; // предпологаем, что самое длинное слово - первое
            $mark = 0;

            for ($i = 1; $i < count($pieces_a); $i++) {
                if (strlen($pieces_a[$i]) > strlen($temp)) {
                    $temp = $pieces_a[$i]; // находим самое длинное слово в массиве
                    $mark = $i;
                }
            }
            $result[] = $temp; // добавляем самое длинное слово в результат
            unset($pieces_a[$mark]); // удаляем это слово из массива
            $pieces_a = array_values($pieces_a); // заново индексируем массив
            $count++;
        }

        return $result;

    } else {
        return null;
    }


}