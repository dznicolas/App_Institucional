<?php

if($tipo == "cadastrar" && isset($email, $senha, $nome)){
    $sql = "INSERT INTO usuario VALUES(0, :nome, :email, :senha)";
    $senha = password_hash($senha, PASSWORD_DEFAULT);
    $cmd = $conexao->prepare($sql);
    $cmd->bindParam(":nome", $nome);
    $cmd->bindParam(":email", $email);
    $cmd->bindParam(":senha", $senha);
    if ($cmd->execute()) {
        retornarStatus(1, "Cadastro realizado com sucesso!");
    }
}?>