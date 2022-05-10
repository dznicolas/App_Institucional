<?php

if($tipo == "alterar"){
    if($_FILES["imagem"]["error"] == 4){
    $sql = "UPDATE endereco SET rua=:rua, bairro=:bairro, cep=:cep, numero=:numero WHERE idendereco=:codigo";
    $comando = $conexao->prepare($sql);
    $comando->bindParam(":codigo", $txtidendereco);
    $comando->bindParam(":rua", $txtrua);
    $comando->bindParam(":bairro", $txtbairro);
    $comando->bindParam(":cep", $txtcep);
    $comando->bindParam(":numero", $txtnumero);
    $comando->execute();
    retornarStatus(1, "Sucuesso ao alterar o endereço.");                        
}else{
    if($_FILES["imagem"]["error"] != 0){
        retornarStatus(0, "Erro ao enviar a imagem");   
    } else{
        excluirImagem($txtidendereco); 
        $imagem = uniqid().".jpg";
        converterImagem($_FILES["imagem"], "../imagens/endereco/".$imagem, 70, 300, 300);
        $sql = "UPDATE endereco SET rua=:rua, bairro=:bairro, cep=:cep, numero=:numero, foto=:foto WHERE idendereco=:codigo";
        $comando = $conexao->prepare($sql);
        $comando->bindParam(":codigo", $txtidendereco);
        $comando->bindParam(":rua", $txtrua);
        $comando->bindParam(":bairro", $txtbairro);
        $comando->bindParam(":cep", $txtcep);
        $comando->bindParam(":numero", $txtnumero);
        $comando->bindParam(":foto", $imagem);
        $comando->execute();
        retornarStatus(1, "Sucuesso ao alterar o endereço.");   
    }
}
}
?>