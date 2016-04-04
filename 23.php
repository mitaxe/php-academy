<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>23</title>
</head>
<body>
<form action="" method="post">
    <input type="text" name="figures">
    <input type="submit" name="sub" value="Посчитать">
</form>
</body>
</html>

<?php
if (isset($_POST['sub'])) {
    if (is_numeric($_POST['figures'])) {
        $figures = $_POST['figures'];
        $result = null;

        for ($i = 0; $i < strlen($figures); $i++) {
            $result += $figures[$i];
        }
        echo $result;
    }
    else echo 'Введите число';
}

?>