<?php
if (!isset($_COOKIE["user_token"])) {
    header("Location: auth");
    exit;
}
require_once "check_token.php";

$profile_picture = $_FILES["profile_picture"]["name"];
$profile_picture_type = $_FILES["profile_picture"]["type"];
$profile_picture_tmp = $_FILES["profile_picture"]["tmp_name"];
$profile_picture_size = null;

$allowed_file_types = ["image/png", "image/jpeg"];

if (!in_array($profile_picture_type, $allowed_file_types)) {
    header("Location: profile?id=" . $user_id);
    exit;
}

$profile_picture_size = filesize($profile_picture_tmp);

if ($userfiles_size > 1048576) {
    header("Location: profile?id=" . $user_id);
    exit;
}

$sql = "SELECT `profile_picture` FROM `users` WHERE id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $past_profile_picture = $row['profile_picture'];

        if ($past_profile_picture != "photo.png") {
            unlink("profile_pictures/" . $past_profile_picture);
        }
    }
}

$profile_picture =  md5(microtime()) . str_replace(" ", "", $profile_picture);
move_uploaded_file($profile_picture_tmp, "profile_pictures/" . $profile_picture);

$profile_picture = $conn->real_escape_string($profile_picture);

$sql = "UPDATE `users` SET profile_picture = '$profile_picture' WHERE id = '$user_id'";
$conn->query($sql);
$conn->close();

header("Location: profile?id=" . $user_id);