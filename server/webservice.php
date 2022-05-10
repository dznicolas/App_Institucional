<?php
    require_once "conexao.php";
    include "acoes/certificar.php";
    function retornarStatus($status, $conteudo, $tipo = "mensagem"){
        global $retorno;
        $retorno["status"] = $status;
        $retorno[$tipo] = $conteudo;
    }
    
    $retorno = array();
    $acoes = array("cadastrar", "deslogar", "deslogar_todos", "logar", "verificar_token");
    extract($_POST);

    $fim = time() + ((3600*24)*15);
    extract($_POST);
    $retorno = array();
    $navegador = 'Disponível';

    if(isset($tipo)){
        if(in_array($tipo, $acoes)){
            require_once("acoes/$tipo.php");
        }
        else{
            retornarStatus(0, "Tipo de requisição inválido.");   
        }
    } else{        
        retornarStatus(0, "Tipo de requisição não informado.");
    }

    echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
?>