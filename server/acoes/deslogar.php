<?php
if($tipo == "deslogar"){

if(verificarLogin()){
    $sql = "DELETE FROM dispositivo WHERE fkusuario = :fkusuario AND token=:token";
    $comando = $conexao->prepare($sql);
    $comando->bindParam(":fkusuario", $_COOKIE["idusuario"]);
    $comando->bindParam(":token", $_COOKIE["token"]);
    $comando->execute();
    setcookie("idusuario", 0, time() - 1, "/Atividade");
    setcookie("token", 0, time() - 1, "/Atividade");
    retornarStatus(1, "status"); 
}else{
    retornarStatus(0, "status"); 
}
}
?>