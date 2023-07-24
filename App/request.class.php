<?php
require_once("autoload.php");

if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["senha"]) && !empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["senha"])){
    $nome = $_POST["name"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $data = array("nome" => $nome, "email" => $email, "senha" => $senha);

    $response = users::cadUser($data);
}
else{
    $response["error"] = "Campos vazios";
}

$json = json_encode($response);

print $json;

?>