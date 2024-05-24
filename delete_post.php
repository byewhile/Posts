<?php
if (!isset($_GET["post_id"])) {
    header("Location: profile");
    exit;
}
require_once "check_token.php";

$post_id = $_GET["post_id"];

$sql = "DELETE FROM `posts` WHERE id = '$post_id'";
$conn->query($sql);

$conn->close();
header("Location: profile?id=" . $user_id);