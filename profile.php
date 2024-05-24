<?php
if (isset($_GET["id"])) {
    $get_user_id = $_GET["id"];
    require_once "find_user_posts.php";
} else {
    header("Location: https://vernonafk.ru");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POSTS | Профиль</title>

    <link rel="shortcut icon" href="img/ico.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <script src="profile.js" defer></script>
    <script src="send_file.js" defer></script>
    <script src="profiles_levels.js" defer></script>
</head>
<body>
    <header>
        <h1><a href="https://vernonafk.ru">POSTS</a></h1>

        <? if ($owner) { ?>
        <span><a href="logout.php">Выйти из профиля</a></span>
        <? } ?>
    </header>
    
    <main>
        <form action="change_profile_picture.php" method="post" enctype="multipart/form-data">
            <h2>
                <? if ($owner) { ?>
                <label for="profile-picture">
                    <img src="profile_pictures/<? echo $user_profile_picture; ?>" alt="Фото" title="Изменить фото профиля">
                </label>
                <? } else { ?>
                    <img src="profile_pictures/<? echo $user_profile_picture; ?>" alt="Фото">
                <? } ?>

                <? echo $user_user_name; ?>
                <a href="sborka_dora">
                    <span class="level" title="Медаль за сборку Доры"><? echo $user_level; ?></span>
                </a>

            </h2>

            <input type="file" name="profile_picture" id="profile-picture" onchange="this.form.submit()" hidden accept=".png, .jpg, .jpeg">
        </form>

        <? if ($owner) { ?>
            <div id="add_post" tabindex="0"><span>Опубликовать POST</span></div>
        <? } ?>

        <form action="add_post.php" method="POST" enctype="multipart/form-data">
            <div class="invisible">
                <textarea title="Напишите ваш POST здесь" placeholder="Напишите ваш POST здесь" name="post_value" maxlength="450" required></textarea>

                <div class="textarea-footer">
                    <label for="file">Прикрепить файл(ы)</label>
                    <input type="file" id="file" name="user_files[]" multiple hidden accept=".rar, .zip, .png, .jpg, .jpeg, .pdf">
                    <input type="submit" value="Опубликовать">
                </div>
            </div>
        </form>
        
        <? for ($i = $user_posts_count - 1; $i >= 0; $i--) { ?>
        <div class="post">
            <div class="post-header">
                <div>
                    <img src="profile_pictures/<? echo $user_profile_picture; ?>" alt="Фото">
                    <span>
                        <a href=""><? echo $user_user_name; ?></a>
                        <a href="sborka_dora">
                            <span class="level" title="Медаль за сборку Доры"><? echo $user_level; ?></span>
                        </a>
                        <br><? echo $user_posts_time[$i]; ?>
                    </span>
                </div>
                
                <? if ($owner) { ?>
                <div>
                    <span><a href="delete_post.php?<? echo "post_id=$user_posts_id[$i]"; ?>">Удалить POST</a></span>
                </div>
                <? } ?>
            </div>

            <div class="post-value">
                <? echo $user_posts_value[$i]; ?>
            </div>
        </div>
        <? } ?>
    </main>
</body>
</html>