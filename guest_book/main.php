<?php
/**
 * @var $guest_comments ;
 */

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Guest Book</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Гостевая книга</h1>
</header>
<main>
    <form action="index.php" method="post">
        <label for="name">Ваше имя</label>
        <input type="text" name="name" id="name" required/>
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" required>
        <div class="subj">
            <label for="subject">Тема</label>
            <input type="text" name="subject" id="subject" required>
        </div>
        <p>Ваш комментарий:</p>
        <textarea name="comment" required></textarea>
        <input type="submit" name="send">
    </form>
</main>
<div class="comments">
    <?php if ($guest_comments !== null) : ?>
        <?php for ($i = 0; $i < count($guest_comments); $i++) : ?>
            <div class="comment__item">
                <div class="comment__item__core">
                    <h2>From: <?= $guest_comments[$i]['name'] . ', ' . $guest_comments[$i]['time'] ?></h2>
                    <h2>Subject: <?= $guest_comments[$i]['subject'] ?></h2>
                </div>
                <p><?= $guest_comments[$i]['comment'] ?></p>
                <?php if ($i !== count($guest_comments) - 1) : ?>
                    <hr>
                <?php endif; ?>
            </div>
        <?php endfor; ?>
    <?php endif; ?>
</div>
</body>
</html>