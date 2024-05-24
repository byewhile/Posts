<?php
if (isset($_COOKIE["user_token"])) {
    header("Location: profile");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POSTS | Авторизация</title>

    <link rel="shortcut icon" href="img/ico.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <script src="main.js" defer></script>
</head>
<body>
    <header>
        <h1><a href="https://vernonafk.ru">POSTS</a></h1>
    </header>

    <main>
        <form action="login.php" method="POST">
            <h2>Вход</h2>

            <input type="text" name="login" placeholder="Введите логин" minlength="5" maxlength="15" required>
            <input type="password" name="password" placeholder="Введите пароль" minlength="5" maxlength="32" required>

            <input class="invisible" type="email" name="email" placeholder="Введите email" minlength="5" maxlength="50" autocomplete="on">
            <input class="invisible" type="password" id="last-input" placeholder="Повторите пароль" maxlength="32">

            <span class="invisible" id="error-text">
            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == 0) {
                    echo "Логин или email уже зарегистрированы!";
                }

                if ($_GET["error"] == 1) {
                    echo "Неправильно набран логин или пароль!";
                }
                
                if ($_GET["error"] == 2) {
                    echo "Запрещено использовать: ?, #, <, >, %, / и пробелы!";
                }
            }
            ?>
            </span>
        
            <input type="submit" value="Войти">

            <span id="helper-text">Нет профиля?</span>
            <span id="change-form" tabindex="0">Зарегистрироваться</span>
        </form>
    </main>
</body>
</html>