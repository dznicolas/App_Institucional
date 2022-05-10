<?php
    if($tipo == "cadastrar"){
        if($_FILES["imagem"]["error"] != 0){
            $retorno["status"] = 0;
            $retorno["mensagem"] = "Por favor, selecione uma imagem válida"; 
        }else{
            $imagem = uniqid().".jpg";
        converterImagem($_FILES["imagem"], "../imagens/endereco/".$imagem, 70, 300, 300);              
        $sql = "INSERT INTO endereco VALUES(0, NULL, :rua, :bairro, :cep, :numero, :foto)";
        $comando = $conexao->prepare($sql);
        $comando->bindParam(":rua", $txtrua);
        $comando->bindParam(":bairro", $txtbairro);
        $comando->bindParam(":cep", $txtcep);
        $comando->bindParam(":numero", $txtnumero);
        $comando->bindParam(":foto", $imagem);
        $comando->execute();
        retornarStatus(1, "Sucuesso ao cadastrar ao endereço.");                        
    }
}
?>