<?php
require_once("App/autoload.php");
session_start();

$homeUrl = "/login/home.php";

if(isset($_SESSION["logged_in"]) or isset($_COOKIE["logged_in_user"])){
    header("Location: http://".$_SERVER['HTTP_HOST'].$homeUrl);
    exit();
}

Tema::setTemaplate("bodyLogin");

?>