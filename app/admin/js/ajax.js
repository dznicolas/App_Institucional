const URL_WEBSERVICE = "http://projetos/Atividade/server/";

function Ajax(metodo, url, dados, funcao){    
    let req = new XMLHttpRequest();
    req.onreadystatechange = function(){
        if (req.readyState == 4 && req.status == 200){
            let objeto = JSON.parse(req.responseText);
            funcao(objeto);
        }
    }
    req.open(metodo, url, true);    
    req.send(dados);
}

verificarLogin = function(posChecagem){
    let dados = new FormData();
    dados.append("tipo", "verificar_token");
    Ajax("POST", URL_WEBSERVICE+"webservice.php", dados, posChecagem);
}