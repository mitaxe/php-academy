<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>27</title>
    <style>
        input[type='text'] {
            width: 30px;
        }
    </style>
</head>
<body>
<form action="" method="post">
    <input type="text" name='rows'>
    <input type="text" name='cols'>
    <input type="submit" name="sub" value="Сгенерировать">
</form>
</body>
</html>

<?php
if (isset($_POST['sub'])) {
    if (is_numeric($_POST['rows']) && is_numeric($_POST['cols'])) {
        $rows = $_POST['rows'];
        $cols = $_POST['cols'];

        if ($rows > 100 || $cols > 100) {
            echo 'Ваш компьютер не настолько крут';
        } else {
            create_table($rows, $cols);
        }

    } else {
        echo 'Задайте правильно количество строк и столбцов';
    }

}

function create_table($rw, $cl)
{
    $colors = ['red', 'yellow', 'blue', 'gray', 'maroon', 'brown', 'green'];

    echo '<table>';

    for ($i = 0; $i < $rw; $i++) {
        echo '<tr>';
        for ($j = 0; $j < $cl; $j++) {
            $random_color = rand(0, count($colors) - 1);
            echo '<td style = background-color:' . $colors[$random_color] . '>' . rand() . '</td>';
        }
        echo '</tr>';
    }

    echo '</table>';
}
?>