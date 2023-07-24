<?php
session_start();
$baseDir = "/login";

unset($_SESSION["logged_in"]);
unset($_COOKIE['logged_in_user']);
setcookie('logged_in_user', null, -1, '/');

header("Location: http://".$_SERVER['HTTP_HOST'].$baseDir);

?>