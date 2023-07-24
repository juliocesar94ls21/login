<?php
require_once("autoload.php");

session_start();

if(isset($_POST["email"]) && isset($_POST["senha"]) && !empty($_POST["email"]) && !empty($_POST["senha"])){

    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $checkedOut = $_POST["checkedOut"];
    $cookie_name = "logged_in_user";
    $cookie_pass = "password";

    $data = array("email" => $email, "senha" => $senha);

    $response = users::getUser($data);

    if(isset($response["sucess"]) and $response["sucess"] == true){
        $_SESSION["logged_in"] = true;
        $_SESSION["user"] = $email;
        $_SESSION["pass"] = $senha;
        $_SESSION["id"] = $response["id"];

        if($checkedOut == 1){
            setcookie($cookie_name, $email, time() + (86400 * 1000 * 1000), "/");
            setcookie($cookie_pass, $senha, time() + (86400 * 1000 * 1000), "/");
        }
    }
}
else{
    $response["error"] = "Campos vazios";
}

$json = json_encode($response);

print $json;

?>