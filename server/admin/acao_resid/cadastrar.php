<?php
if($tipo == "cadastrar"){
    $sql = "INSERT INTO residente VALUES(0, :nome, :idade, :trabalho, :telefone, :qt_pessoas)";
    $comando = $conexao->prepare($sql);
    $comando->bindParam(":nome", $txtnome);
    $comando->bindParam(":idade", $txtidade);
    $comando->bindParam(":trabalho", $txttrabalho);
    $comando->bindParam(":telefone", $txttelefone);
    $comando->bindParam(":qt_pessoas", $txtqt_pessoas);
    $comando->execute();
    retornarStatus(1, "Sucesso ao cadastrar o residente.");                        
}

?>