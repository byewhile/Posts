<?php
if (!isset($_COOKIE["user_token"])) {
    header("Location: auth");
    exit;
}
require_once "check_token.php";

$post_value = htmlspecialchars(trim($_POST["post_value"]));
date_default_timezone_set('Europe/Moscow');
$time = date("d.m.y H:i");

if (strlen($post_value) > 450) {
    header("Location: profile?id=" . $user_id);
    exit;
}

if (!empty($_FILES["user_files"]["name"][0])) {
    $userfiles = [];
    $userfiles_type = $_FILES["user_files"]["type"];
    $userfiles_tmp = $_FILES["user_files"]["tmp_name"];
    $userfiles_size = [];

    $allowed_file_types = ["application/x-zip-compressed", "application/zip","application/x-zip", "application/x-winzip", "application/x-compressed", "application/x-rar-compressed", "image/png", "image/jpeg", "application/pdf"];

    for ($i = 0; $i < sizeof($_FILES["user_files"]["name"]); $i++) {
        if (!in_array($userfiles_type[$i], $allowed_file_types)) {
            header("Location: profile?id=" . $user_id);
            exit;
        }

        array_push($userfiles, "uploads/" . md5(microtime()) . str_replace(" ", "", $_FILES["user_files"]["name"][$i]));
        array_push($userfiles_size, filesize($userfiles_tmp[$i]));
    }

    if (array_sum($userfiles_size) > 5242880) {
        header("Location: profile?id=" . $user_id);
        exit;
    }
    
    $post_value = explode(" ", $post_value);

    for ($i = 0; $i < sizeof($userfiles); $i++) { 
        move_uploaded_file($userfiles_tmp[$i], $userfiles[$i]);

        $post_value[$i] = "<a href=$userfiles[$i] download=$post_value[$i]>$post_value[$i]</a>";
    }

    $post_value = implode(" ", $post_value);
}

$post_value = $conn->real_escape_string($post_value);

$sql = "INSERT INTO `posts` (user_id, value, time) VALUES ('$user_id', '$post_value', '$time')";
$conn->query($sql);
$conn->close();

// mail("AlekseyTarkov@ya.ru", $user_login . " опубликовал новый POST", $user_login . " опубликовал новый POST\nСодержимое POST'а: " . $post_value . "\nhttps://vernonafk.ru");

header("Location: profile?id=" . $user_id);