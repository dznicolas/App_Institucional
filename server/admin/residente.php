<?php
include "../conexao.php";
$retorno = array();
extract($_POST);
$acao_resid = array("cadastrar", "alterar", "consultar", "excluir", "listagem");

function retornarStatus($status, $conteudo, $tipo = "mensagem")
{
    global $retorno;
    $retorno["status"] = $status;
    $retorno[$tipo] = $conteudo;
}

if (isset($tipo)) {
    if (in_array($tipo, $acao_resid)) {
        require_once("acao_resid/$tipo.php");
    } else {
        retornarStatus(0, "Tipo de requisição inválida.");
    }
} else {
    retornarStatus(0, "Tipo de requisição não informada.");
}

echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
?>