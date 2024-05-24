<?php
if (isset($_COOKIE["user_token"])) {
    require_once "check_token.php";
} else {
    require_once "db.php";
}

$sql = "SELECT * FROM `posts`";
$result = $conn->query($sql);

$global_posts_count = 0;
$global_users_id = [];
$global_posts_value = [];
$global_posts_time = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($global_users_id, $row['user_id']);
        array_push($global_posts_value, $row['value']);
        array_push($global_posts_time, $row['time']);
        $global_posts_count++;
    }
    $global_users_name = [];
    $global_users_profile_pictures = [];
    $global_users_level = [];

    foreach ($global_users_id as $global_user_id) {
        $sql = "SELECT `login`, `profile_picture`, `level` FROM `users` WHERE id = '$global_user_id'";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            array_push($global_users_name, $row['login']);
            array_push($global_users_profile_pictures, $row['profile_picture']);
            array_push($global_users_level, $row['level']);
        }
    }
}
$conn->close();