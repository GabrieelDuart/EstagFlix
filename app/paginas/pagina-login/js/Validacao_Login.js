// Obtém a referência ao botão de envio do formulário
var BotaoEnviar = document.getElementById("Btn_Entrar");

// Registra um evento de clique no botão de envio
BotaoEnviar.addEventListener("click", function(event) {

  // Obtém as referências aos campos de entrada de nome e senha
  var campoNome = document.getElementById("user");
  var campoSenha = document.getElementById("password");

  // Obtém os valores dos campos de entrada
  var valorNome = campoNome.value;
  var valorSenha = campoSenha.value;

  // Exibe os valores dos campos de entrada na janela do navegador
  console.log("Nome: " + valorNome);
  console.log("Senha: " + valorSenha);

  // Código de verificação 

  var pagina1 = "../pagina-filmes"

  if (valorNome == "Gab" && valorSenha == "123") {
    window.location.href = pagina1;
    event.preventDefault(); // evita o envio do formulário
  }else{
    alert("Usuario ou senha incorretos"); 
  }

});