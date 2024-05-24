<? require_once "find_global_post.php"; ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="POSTS - cервис микроблогов, в котором пользователи публикуют сообщения, известные как «посты»">
    <title>POSTS | Главная страница</title>
    
    <link rel="shortcut icon" href="img/ico.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <script src="profiles_levels.js" defer></script>
</head>
<body>
    <header>
        <h1>POSTS</h1>
        <nav>
            <img src="img/user.png" alt="Иконка пользователя">

            <? if (isset($user_login)) { ?>
                <a href="profile?id=<? echo $user_id; ?>"><? echo $user_login; ?></a>
            <? } else {?>
                <a href="auth">Профиль</a>
            <? } ?>
        </nav>
    </header>

    <main>
        <h2>Лента POST'ов</h2>

        <? for ($i = $global_posts_count - 1; $i >= $global_posts_count - 20; $i--) { ?>
        <? if ($i < 0) { break; } ?>
        <div class="post">
            <div class="post-header">
                <div>
                    <img src="profile_pictures/<? echo $global_users_profile_pictures[$i]; ?>" alt="Фото">
                    <span>
                        <a href="profile?id=<? echo $global_users_id[$i]; ?>"><? echo $global_users_name[$i]; ?></a>
                        <a href="sborka_dora">
                            <span class="level" title="Медаль за сборку Доры"><? echo $global_users_level[$i]; ?></span>
                        </a>
                        <br><? echo $global_posts_time[$i]; ?>
                    </span>
                </div>
            </div>

            <div class="post-value">
                <? echo $global_posts_value[$i]; ?>
            </div>
        </div>
        <? } ?>
    </main>
</body>
</html>