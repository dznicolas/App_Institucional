<?php
if($tipo == "excluir"){
    $sql = "DELETE FROM residente WHERE idresidente=:codigo";
    $comando = $conexao->prepare($sql);             
    $comando->bindParam(":codigo", $codigo);
    $comando->execute();
    retornarStatus(1, "Sucesso ao excluir o residente com o código $codigo.");
}

?>