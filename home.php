<?php
require_once("App/autoload.php");

session_start();

$baseDir = "/login";

if(!isset($_SESSION["logged_in"]) and !isset($_COOKIE["logged_in_user"])){
    header("Location: http://".$_SERVER['HTTP_HOST'].$baseDir);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    users::updateUser($_POST);
}

$baseDir = "/login";

$user = null;
$senha = null;

if(isset($_COOKIE["logged_in_user"])){
    $user = $_COOKIE["logged_in_user"];
}
if(isset($_COOKIE["password"])){
    $pass = $_COOKIE["password"];
}
if(isset($_SESSION["user"])){
    $user = $_SESSION["user"];
}
if(isset($_SESSION["pass"])){
    $pass = $_SESSION["pass"];
}

$data = array("email" => $user, "senha" => $pass);

$response = users::getUser($data);

Tema::setTemaplate("bodyHome",$response);

?>