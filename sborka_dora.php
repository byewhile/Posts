<?php 
require_once "check_token.php"; 

if (isset($_GET['level_up'])) {
    sleep(2);
    $sql = "UPDATE `users` SET level = level + 1 WHERE id = '$user_id'";
    $conn->query($sql);
    $conn->close();
    header("Location: sborka_dora");
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POSTS | Сборка Доры</title>

    <link rel="shortcut icon" href="img/ico.png" type="image/png">
    <link rel="stylesheet" href="sborka_dora.css">
    <script src="profiles_levels.js" defer></script>
    <script src="sborka_dora.js" defer></script>
</head>
<body>
    <header>
        <h1><a href="https://vernonafk.ru">POSTS</a> | Сборка Доры</h1>

        <h2>Ваша медаль: <span class="level"><? echo $user_level; ?></span></h2>
    </header>

    <main>
        <img src="" alt="">
        <img src="" alt="">
        <img src="" alt="">
        <img src="" alt="">
        <img src="" alt="">
        <img src="" alt="">
        <img src="" alt="">
        <img src="" alt="">
        <img src="" alt="">
    </main>

    <footer>
        <button>Собрать Дору</button>
    </footer>
</body>
</html>