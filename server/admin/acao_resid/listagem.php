<?php
if($tipo == "listagem"){
    $sql = "SELECT * FROM residente WHERE nome LIKE :filtro";
    $comando = $conexao->prepare($sql);             
    $comando->bindParam(":filtro", $filtro);
    $comando->execute();
    $lista = $comando->fetchAll(PDO::FETCH_ASSOC);
    retornarStatus(1, $lista, "lista");
}

?>