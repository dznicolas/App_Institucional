<?php

if ($tipo == "logar" && isset($email, $senha)) {
    $sql = "SELECT idusuario, nome, senha FROM usuario WHERE email=:email";
    $cmd = $conexao->prepare($sql);
    $cmd->bindParam(":email", $email);
    $cmd->execute();
    $dados = $cmd->fetch(PDO::FETCH_ASSOC);
    if (isset($dados["idusuario"])){
        if (password_verify($senha, $dados["senha"])) {
            $retorno["status"] = 1;
            $retorno["nome"] = $dados["nome"];
            $retorno["idusuario"] = $dados["idusuario"];

            $token = bin2hex(random_bytes(32));
            $sqlDispositivo = "INSERT INTO dispositivo VALUES(0,:so,NOW(),:token,:fkusuario)";
            $cmdDispositivo = $conexao->prepare($sqlDispositivo);
            $cmdDispositivo->bindParam(":so",$navegador);
            $cmdDispositivo->bindParam(":token",$token);
            $cmdDispositivo->bindParam(":fkusuario",$dados["idusuario"]);
            $cmdDispositivo->execute();

            setcookie("token", $token, $fim, "/Atividade"); 
            setcookie("idusuario", $dados["idusuario"], $fim, "/Atividade");

        }else{
            retornarStatus(0, "Senha inválida");
        }
    }else{
        retornarStatus(0, "Usuario não encontrado.");
    }
    
}

?>