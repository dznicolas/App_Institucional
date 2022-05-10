<?php
 if($tipo == "alterar"){
    $sql = "UPDATE residente SET nome=:nome, idade=:idade, trabalho=:trabalho, telefone=:telefone,
    qt_pessoas=:qt_pessoas WHERE idresidente=:codigo";
    $comando = $conexao->prepare($sql);
    $comando->bindParam(":codigo", $txtidresidente);
    $comando->bindParam(":nome", $txtnome);
    $comando->bindParam(":idade", $txtidade);
    $comando->bindParam(":trabalho", $txttrabalho);
    $comando->bindParam(":telefone", $txttelefone);
    $comando->bindParam(":qt_pessoas", $txtqt_pessoas);
    $comando->execute();
    retornarStatus(1, "Sucesso ao alterar residente.");                        
}

?>