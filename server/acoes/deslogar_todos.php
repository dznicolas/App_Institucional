<?php
if($tipo == "deslogar_todos"){ 

if(verificarLogin()){
    $sql = "DELETE FROM dispositivo WHERE fkusuario = :fkusuario";
    $comando = $conexao->prepare($sql);
    $comando->bindParam(":fkusuario", $_COOKIE["idusuario"]);
    $comando->execute();
    setcookie("idusuario", 0, time() - 1, "/Atividade");
    setcookie("token", 0, time() - 1, "/Atividade");
    retornarStatus(1, "status"); 
}else{
    retornarStatus(0, "status"); 
}
}
?>