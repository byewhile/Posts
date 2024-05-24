<?php
$login = trim($_POST["login"]);
$password = trim($_POST["password"]);
$email = trim($_POST["email"]);

$banned_symbols = ["", " ", "?", "#", "<", ">", "%", "/"];
$inputs_data = array_merge(str_split($login), str_split($password), str_split($email));

for ($i = 0; $i < sizeof($inputs_data); $i++) { 
    if (in_array($inputs_data[$i], $banned_symbols)) {
        header("Location: auth?error=2");
        exit;
    }
}
$password = md5($password);

require_once "db.php";
$sql = "SELECT `id` FROM `users` WHERE login = '$login' OR email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $conn->close();
    header("Location: auth?error=0");
    exit;
}

$token = md5(microtime() . $login . time());

$sql = "INSERT INTO `users` (login, password, email, token) VALUES ('$login', '$password', '$email', '$token')";
$conn->query($sql);

$sql = "SELECT `id`, `token` FROM `users` WHERE token = '$token'";
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
}