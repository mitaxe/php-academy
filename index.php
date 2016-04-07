<?php

// Работа с foreach

// № 1

$pr_language = ['html', 'css', 'php', 'js', 'jq'];

foreach ($pr_language as $value) {
    echo $value . "\n";
}

// № 2

$arr = [1, 20, 15, 17, 24, 35];
$result = null;

foreach ($arr as $value) {
    $result += $value;
}

echo "\n" . $result . "\n\n";

// № 3

$arr = [26, 17, 136, 12, 79, 15];
$result = null;

foreach ($arr as $value) {
    $result += $value * $value;
}

echo $result . "\n\n";


// Работа с ключами

// № 4

$arr = array('green' => 'зеленый', 'red' => 'красный', 'blue' => 'голубой');


foreach ($arr as $key => $value) {
    echo $key . "\n";
}

echo "\n\n";

foreach ($arr as $value) {
    echo $value . "\n";
}

echo "\n";

// № 5

$arr = ['Коля' => '200', 'Вася' => '300', 'Петя' => '400'];

foreach ($arr as $key => $value) {
    echo $key . ' - зарплата ' . $value . ' долларов.' . "\n";
}

echo "\n";
// № 6

$arr = array('green' => 'зеленый', 'red' => 'красный', 'blue' => 'голубой');
$en = [];
$ru = [];


foreach ($arr as $key => $value) {
    $en[] = $key;
    $ru[] = $value;
}

print_r($ru);
echo "\n";
print_r($en);
echo "\n\n";

// № 7

$arr = [2, 5, 9, 15, 0, 4];

foreach ($arr as $value) {
    if ($value > 3 && $value < 10) {
        echo $value . "\n";
    }
}

// № 8
echo "\n";

$arr = [1, 2, 3, 4, 5, 6, 7, 8, 9];

foreach ($arr as $value) {
    echo $value;
}

// Циклы while и for

// № 9
echo "\n\n";
for ($i = 0; $i <= 100; $i++) {
    echo $i . "\n";
}

// № 10
echo "\n\n";
for ($i = 11; $i <= 33; $i++) {
    echo $i . "\n";
}

// № 11
echo "\n\n";
for ($i = 0; $i <= 100; $i += 2) {
    echo $i . "\n";
}

// № 12
echo "\n\n";

$n = 1000;
$num = null;

while ($n > 50) {
    $n = $n / 2;
    $num++;
}

echo 'Необходимо ' . $num . " итераций";

// № 13
echo "\n\n";

for ($i = 0; $i <= 10; $i++) {
    for ($j = 0; $j <= 10; $j++) {
        echo $i . ' * ' . $j . ' = ' . $i * $j . "\n";
    }
    echo "\n";
}

// № 14
echo "\n\n";

$arr = [4, 2, 5, 19, 13, 0, 10];
$e = [2, 3, 4];
$in_array = false;

for($i = 0; $i < sizeof($e); $i++) {
    if(in_array($e[$i], $arr)) {
        $in_array = true;
        break;
    }
}

if($in_array) {
    echo 'Есть!';
} else {
    echo 'Нет!';
}

// № 15
echo "\n\n";

$arr = [4, 2, 5, 19, 13, 0, 10];
$count = 0;

foreach ($arr as $value) {
    $count++;
}

echo $count;

// № 16
echo "\n\n";

$arr = [1, 2, 3, 4, 5, 6, 7, 8, 9];

foreach ($arr as $key => $value) {
    if ($key == count($arr) - 1) {
        echo $value;
    } else {
        echo $value . ', ';
    }

    if (++$key % 3 == 0) {
        echo "\n";
    }
}

// № 17
echo "\n\n";

$all_months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
    'October', 'November', 'December'];

$month = date('F');

foreach ($all_months as $value) {
    if ($value == $month) {
        echo '<b>' . $value . '</b>';
    }
}


// № 18
echo "\n\n";

$days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

foreach ($days as $key => $value) {
    if ($key == 0 || $key == 6) {
        echo '<b>' . $value . '</b>';
    } else {
        echo $value . ' ';
    }
}

// № 19
echo "\n\n";

$days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
$day = date('l');
foreach ($days as $value) {
    if ($value == $day) {
        echo '<i>' . $value . ' </i>';
    } else {
        echo $value . ' ';
    }
}

// № 20
echo "\n\n";

for ($i = 20; $i >= 0; $i--) {
    for ($j = $i; $j <= 20; $j++) {
        echo 'x';
    }
    echo "\n";
}

// № 21
echo "\n\n";

for ($i = 1; $i < 10; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo $i;
    }
    echo "\n";
}


// № 22
echo "\n\n";

$k = 2;

for ($i = 0; $i < 5; $i++) {
    for ($j = 0; $j < $k; $j++) {
        echo 'x';
    }
    $k += 2;
    echo "\n";

}

// № 25

$arr = [];

for ($i = 0; $i < 10; $i++) {
    $arr[$i] = rand();
    echo $arr[$i] . ' ';
}

print_r($arr);

$min = $arr[0];
$max = $arr[0];

$pos_min = 0;
$pos_max = 0;

for ($i = 1; $i < 10; $i++) {
    if ($arr[$i] < $min) {
        $min = $arr[$i];
        $pos_min = $i;
    } elseif ($arr[$i] > $max) {
        $max = $arr[$i];
        $pos_max = $i;
    }
}

//list($arr[$pos_min], $arr[$pos_max]) = array($arr[$pos_max], $arr[$pos_min]);

$arr[$pos_min] ^= $arr[$pos_max];
$arr[$pos_max] ^= $arr[$pos_min];
$arr[$pos_min] ^= $arr[$pos_max];
print_r($arr);




// № 26
echo "\n\n";

$multiply = 1;
$arr = [];
for($i = 0; $i < 10; $i++) {
    $arr[$i] = rand(1,100);
}

print_r($arr);

for($i = 0; $i < 10; $i++) {
    if(($arr[$i] > 0) && ($i % 2 == 0 )) {
        $multiply*=$arr[$i];
    }
    elseif($arr[$i] > 0) {
        echo $arr[$i].' ';
    }

}

