const formulario = document.getElementById("formulario");
const corpoTabela = document.querySelector("table tbody");
const txtFiltrar = document.getElementById("txtfiltrar");
const inputIDExclusao = document.getElementById("idexclusao");
var modalExclusao = null;

document.addEventListener('DOMContentLoaded', function() {   
    M.Modal.init(document.querySelectorAll('.modal'));
    modalExclusao = M.Modal.getInstance(document.querySelector("#modalExclusao"));
});


cadastrar = function(retorno){
    console.log(retorno);
    if(retorno.status == 1){
        M.toast({html: retorno.mensagem, classes: "light-green darken-4"})
        executarListagem();
    }else{
        M.toast({html: retorno.mensagem, classes: "red darken-4"})    
    }
}


excluir = function(codigo){   
    inputIDExclusao.value = codigo;
    modalExclusao.open();
}

posExcluir = function(retorno){
    if(retorno.status == 1){
        M.toast({html: retorno.mensagem, classes: "light-green darken-4"});        
        executarListagem();
    }else{
        M.toast({html: retorno.mensagem, classes: "red darken-4"});   
    }
    modalExclusao.close();
}


pegarDados = function(codigo){
    let req_PegarDados = new FormData();
    req_PegarDados.append("tipo", "consultar");
    req_PegarDados.append("codigo", codigo);
    Ajax("POST", URL_WEBSERVICE+"admin/residente.php", req_PegarDados, preencher_for); 
}

executarExclusao = function(){
    let requisicaoExcluir = new FormData();
    requisicaoExcluir.append("tipo", "excluir");
    requisicaoExcluir.append("codigo", inputIDExclusao.value);
    Ajax("POST", URL_WEBSERVICE+"admin/residente.php", requisicaoExcluir, posExcluir);
}


preencher_for = function(retorno){
    if(retorno.status == 1){
        formulario["txtidresidente"].value = retorno.dados.idresidente;  
        formulario["txtnome"].value = retorno.dados.nome;  
        formulario["txtidade"].value = retorno.dados.idade;
        formulario["txttrabalho"].value = retorno.dados.trabalho;
        formulario["txttelefone"].value = retorno.dados.telefone;
        formulario["txtqt_pessoas"].value = retorno.dados.qt_pessoas;
        formulario["btncadastrar"].innerHTML = "<i class='material-icons left'>save</i>Salvar";
        M.updateTextFields();
    }else{
        alert(retorno.mensagem);
    }
}

listar = function(retorno){
    if(retorno.status == 1){
    retorno.lista.forEach(pos => {           
            corpoTabela.innerHTML += `<tr>
                <td>${pos.idresidente}</td>
                <td>${pos.nome}</td>
                <td>${pos.idade}</td>
                <td>${pos.trabalho}</td>
                <td>${pos.telefone}</td>
                <td>${pos.qt_pessoas}</td>
                <td>
                <a href="javascript:excluir(${pos.idresidente});"  style="color: black; font-size: 18px">Excluir</a>
                <a> - <a>
                <a href="javascript:pegarDados(${pos.idresidente});"  style="color: black; font-size: 18px">Alterar</a>
            </td>
        </tr>`;
        });
    }
}

formulario.addEventListener("submit", function(e){
    e.preventDefault();
    let dados = new FormData(formulario);
    if(isNaN(dados.get("txtidresidente"))){
        dados.append("tipo", "cadastrar");
    }else{
        dados.append("tipo", "alterar");
        formulario["txtidresidente"].value = isNaN;
        
    }
    Ajax("POST", URL_WEBSERVICE+"admin/residente.php", dados, cadastrar);
});

formulario.addEventListener("reset", ()=>{    
    formulario["btncadastrar"].innerHTML = "<i class='material-icons left'>add</i>Cadastrar";
    setTimeout(()=>{
        M.updateTextFields();
    },0);    
});


txtFiltrar.addEventListener("keyup", () => {
let filtro = txtFiltrar.value;
executarListagem(filtro);
});

executarListagem = function (filtro = "") {
corpoTabela.innerHTML = "";
let r_Listar = new FormData();
r_Listar.append("tipo", "listagem");
r_Listar.append("filtro", "%" + filtro + "%");
Ajax("POST", URL_WEBSERVICE + "admin/residente.php", r_Listar, listar);
}
executarListagem();

verificarLogin = function(retorno){
    if(retorno.status == 0){
        window.open("index.html", "_top");
    }
};