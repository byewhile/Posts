<?php
$owner = false;
if (isset($_COOKIE["user_token"])) {
    require_once "check_token.php";

    if ($get_user_id == $user_id) {
        $owner = true;
    }
} else {
    require_once "db.php";
}

$sql = "SELECT `login`, `profile_picture`, `level` FROM `users` WHERE id = '$get_user_id' LIMIT 1";
$result = $conn->query($sql);

$user_user_name = null;
$user_profile_picture = null;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $user_user_name = $row['login'];
        $user_profile_picture = $row['profile_picture'];
        $user_level = $row['level'];
    }
}

$sql = "SELECT * FROM `posts` WHERE user_id = '$get_user_id'";
$result = $conn->query($sql);

$user_posts_count = 0;
$user_posts_id = [];
$user_posts_value = [];
$user_posts_time = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($user_posts_id, $row['id']);
        array_push($user_posts_value, $row['value']);
        array_push($user_posts_time, $row['time']);
        $user_posts_count++;
    }
}
$conn->close();