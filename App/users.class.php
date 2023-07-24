<?php
require_once("autoload.php");

class users{

    public static function cadUser($values){
        $dataReturn = array();
        $db = new db();
        $conn = $db->getConnection();
        $query = "insert into usuarios values(' ', ?, ?, ?)";
        try{
            $statement = $conn->prepare($query);
            $statement->execute(array_values($values));
            return $dataReturn["sucess"] = true;
        }
        catch(PDOException $e) {
            return $dataReturn["error"] = $e->getMessage();
        }
        
    }
    public static function getUser($values){
        $dataReturn = array();
        $baseDir = "/login";
        $db = new db();
        $conn = $db->getConnection();
        $query = "select * from usuarios where email = ? and senha = ?";
        try{
            $statement = $conn->prepare($query);
            $statement->execute(array_values($values));
            if($statement->rowCount() > 0){
                foreach($statement as $registros){
                    $dataId = $registros["id"];
                    $dataNome = $registros["nome"];
                    $dataEmail = $registros["email"];
                    $dataSenha = $registros["senha"];
                }
                return $dataReturn[] = array("sucess" => true, "redirect" => $baseDir."/home.php?id=".$dataId, "nome" => $dataNome, "email" => $dataEmail, "senha" => $dataSenha, "id" => $dataId);
            }
            else{
                return $dataReturn[] = array("error" => "Usuário ou senha incorretos");    
            }
        }
        catch(PDOException $e) {
            return $dataReturn[] = array("error" => $e->getMessage());
        }
    }
    public static function updateUser($values){
        $dataReturn = array();
        $baseDir = "/login";
        $db = new db();
        $conn = $db->getConnection();
        $query = "update usuarios set nome=? , email=?, senha=? where id=? ";
        $args = array($values["nome"],$values["email"],$values["senha"],$_GET["id"]);
        try{
            $statement = $conn->prepare($query);
            $statement->execute($args);
            $_SESSION["user"] = $values["email"];
            $_SESSION["pass"] = $values["senha"];
            return $dataReturn["sucess"] = true;
        }
        catch(PDOException $e) {
            print($e->getMessage());
        }
    }
}
?>