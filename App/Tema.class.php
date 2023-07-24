<?php

class Tema{
    public static function setTemaplate($view,$replace = null){
        $viewFile = file_get_contents("views/".$view.".html");
        $viewHead = file_get_contents("views/head.html");

        if($view == "bodyHome"){
            $viewFile = str_replace(array("{nome}","{email}","{password}"),array($replace["nome"],$replace["email"],$replace["senha"]),$viewFile);
        }

        if(file_exists("views/head.html")){
            print($viewHead);
        }else{
            print("Arquivo não existe");
        }
        if(file_exists("views/".$view.".html")){
            print($viewFile);
        }else{
            print("Arquivo não existe");
        }
    }
}

?>