// RewriteEngine On
// RewriteCond %{REQUEST_FILENAME} !-d
// RewriteCond %{REQUEST_FILENAME}\.php -f
// RewriteRule ^(.*)$ $1.php

<?php
$server = "localhost";
$dbusername = "";
$dbpassword = "";
$dbname = "posts";

$conn = new mysqli($server, $dbusername, $dbpassword, $dbname);
