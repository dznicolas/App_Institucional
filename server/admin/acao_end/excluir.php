<?php
    if($tipo == "excluir"){

        excluirImagem($codigo);
        $sql = "DELETE FROM endereco WHERE idendereco=:idendereco";
        $comando = $conexao->prepare($sql);             
        $comando->bindParam(":idendereco", $codigo);
        $comando->execute();
        retornarStatus(1, "Sucesso ao excluir o endereco com o código $codigo.");  
    }
?>