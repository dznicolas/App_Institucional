<?php
if($tipo == "consultar"){
    $sql = "SELECT * FROM endereco WHERE idendereco = :codigo";
    $comando = $conexao->prepare($sql);             
    $comando->bindParam(":codigo", $codigo);
    $comando->execute();
    $dados = $comando->fetch(PDO::FETCH_ASSOC);            
    if(!$dados){
        retornarStatus(0, "Item não encontrado");   
    }else{
        retornarStatus(1, $dados, "dados");
    }
}
?>