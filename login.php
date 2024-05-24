<?php
require_once "db.php";

$login = trim($_POST["login"]);
$password = md5(trim($_POST["password"]));

$sql = "SELECT `id`, `token` FROM `users` WHERE login = '$login' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $user_id = $row['id'];
        $user_token = $row['token'];
    }

    setcookie("user_token", $user_token, time() + 172800);
    $_COOKIE["user_token"] = $user_token;

    $conn->close();
    header("Location: profile?id=$user_id");
    exit;
}

$conn->close();
header("Location: auth?error=1");