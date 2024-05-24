<?php
setcookie("user_token", null);
$user_id = null;
$user_login = null;
$user_level = null;
header("Location: auth");