<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>24</title>
</head>
<body>
<form action="" method="post">
    <input type="text" name="figures">
    <select name="choose_figure">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>

    </select>
    <input type="submit" name="sub" value="Посчитать">
</form>
</body>
</html>

<?php
if (isset($_POST['sub'])) {
    if (is_numeric($_POST['figures'])) {
        $figures = $_POST['figures'];
    }

    $choose_figure = $_POST['choose_figure'];
    $count = how_many($figures, $choose_figure);
    echo $count;
}

function how_many($a, $b) {
    $count = 0;

    for($i = 0; $i < strlen($a); $i++) {
        if($a[$i] == $b) {
            $count++;
        }
    }

    return $count;
}

?>