<?php
function verificarLogin(){
    global $conexao;
    if(isset($_COOKIE["token"], $_COOKIE["idusuario"])){
        $sql = "SELECT count(*) 'existe' FROM dispositivo WHERE token=:token AND fkusuario=:idusuario AND NOW()<DATE_ADD(datacriacao, INTERVAL 30 DAY)";
        $comando = $conexao->prepare($sql);
        $comando->bindParam(":token", $_COOKIE["token"]);
        $comando->bindParam(":idusuario", $_COOKIE["idusuario"]);
        $comando->execute();
        $verificar = $comando->fetch(PDO::FETCH_ASSOC);
        if($verificar["existe"] == 1){
            return 1;
        }else{
            return 0;
        }
    }else{
        return 0;
    }
}

?>