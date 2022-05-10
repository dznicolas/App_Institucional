const formulario = document.getElementById("formulario");
const corpoTabela = document.querySelector("table tbody");
const txtFiltrar = document.getElementById("txtfiltrar");
const imgTemp = document.getElementById("imgTemp");
const divImg = document.getElementById("divImg");
const inputIDExclusao = document.getElementById("idexclusao");
const enderecoimagem = "http://projetos/Atividade/server/imagens/endereco/";
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
    Ajax("POST", URL_WEBSERVICE+"admin/endereco.php", req_PegarDados, preencher_for);
}

executarExclusao = function(){
    let requisicaoExcluir = new FormData();
    requisicaoExcluir.append("tipo", "excluir");
    requisicaoExcluir.append("codigo", inputIDExclusao.value);
    Ajax("POST", URL_WEBSERVICE+"admin/endereco.php", requisicaoExcluir, posExcluir);
}


preencher_for = function(retorno){
    if(retorno.status == 1){
        formulario["txtidendereco"].value = retorno.dados.idendereco;  
        formulario["txtrua"].value = retorno.dados.rua;  
        formulario["txtbairro"].value = retorno.dados.bairro;
        formulario["txtcep"].value = retorno.dados.cep;
        formulario["txtnumero"].value = retorno.dados.numero;
        imgTemp.setAttribute("src", enderecoimagem + retorno.dados.foto);
        divImg.style.display = "block";
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
                <td>${pos.idendereco}</td>
                <td>${pos.rua}</td>
                <td>${pos.bairro}</td>
                <td>${pos.cep}</td>
                <td>${pos.numero}</td>
                <td><img src="${enderecoimagem+pos.foto}" height="80px"/></td>
                <td>
                    <a href="javascript:excluir(${pos.idendereco});" style="color: black; font-size: 18px">Excluir</a>
                    <a> - <a>
                    <a href="javascript:pegarDados(${pos.idendereco});" style="color: black; font-size: 18px">Alterar</a>
                </td>
            </tr>`;
    });
    }
}

formulario.addEventListener("submit", function(e){
    e.preventDefault();
    let dados = new FormData(formulario);
    if(isNaN(dados.get("txtidendereco"))){
        dados.append("tipo", "cadastrar");
    }else{
        dados.append("tipo", "alterar");
        formulario["txtidendereco"].value = isNaN;
        
    }
    Ajax("POST", URL_WEBSERVICE+"admin/endereco.php", dados, cadastrar);
});

formulario.addEventListener("reset", ()=>{    
    formulario["btncadastrar"].innerHTML = "<i class='material-icons left'>add</i>Cadastrar";
    divImg.style.display = "none";
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
Ajax("POST", URL_WEBSERVICE + "admin/endereco.php", r_Listar, listar);
}
executarListagem();
divImg.style.display = "none";

verificarLogin = function(retorno){
    if(retorno.status == 0){
        window.open("index.html", "_top");
    }
};