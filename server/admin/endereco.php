<?php
    include "../conexao.php";
    include "../funcoes.php";
    
    $retorno = array();
    extract($_POST);
    $acao_end = array("cadastrar", "alterar", "consultar", "excluir", "listagem");

    function excluirImagem($paramCodigo){
        global $conexao;
        $sqlVerificar = "SELECT foto FROM endereco WHERE idendereco=:idendereco";
        $comandofoto = $conexao->prepare($sqlVerificar);
        $comandofoto->bindParam(":idendereco", $paramCodigo);
        $comandofoto->execute();
        $nomeImagem = $comandofoto->fetch(PDO::FETCH_ASSOC)["foto"];
        unlink("../imagens/endereco/$nomeImagem");  
    }

    function retornarStatus($status, $conteudo, $tipo = "mensagem"){
        global $retorno;
        $retorno["status"] = $status;
        $retorno[$tipo] = $conteudo;
    }


    if(isset($tipo)){
        if(in_array($tipo, $acao_end)){
            require_once("acao_end/$tipo.php");
        }
        else{
            retornarStatus(0, "Tipo de requisição inválido.");   
        }
    } else{        
        retornarStatus(0, "Tipo de requisição não informado.");
    }
    echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
?>