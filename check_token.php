<?php
require_once "db.php";
$user_token = $_COOKIE["user_token"];

$sql = "SELECT `id`, `login`, `level` FROM `users` WHERE token = '$user_token'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $user_id = $row['id'];
        $user_login = $row['login'];
        $user_level = $row['level'];
    }
} else {
    $conn->close();
    header("Location: logout");
    exit;
}