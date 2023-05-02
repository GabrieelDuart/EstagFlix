<?php 
session_start();
include("conexao-banco.php");

// verifica se o registro do cadastro veio vazio ou não se vem ele redireciona para o login

if(empty($_POST['user']) || empty($_POST['senha_cadastro']) || empty($_POST['email']) || empty($_POST['c_senha_cadastro']) ){
    header("location: ../index.php");
    exit();
}

$user = $_POST['user'];
$senha_cadastro = $_POST['senha_cadastro'];
$c_senha_cadastro = $_POST['c_senha_cadastro'];
$email = $_POST['email'];


// verifica se já existe um email 

$query = ("select email from usuario where email = '$email';");


$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

if($row == 1) {
    $_SESSION['email_existente'] = true;
    header("location: ../index.php");
    exit();

}else{
    
    // verifica se já existe um usuario no banco
    
    $query = ("select usuario from usuario where usuario = '$user';");

    $result = mysqli_query($conexao, $query);
    
    $row = mysqli_num_rows($result);
    
    if($row == 1) {
        $_SESSION['usuario_existente'] = true;
        header("location: ../index.php");
        exit();
    }else{
        
        // verifica se a senha é a mesma da confirmação da senha
    
        if($senha_cadastro == $c_senha_cadastro){
            $_SESSION['cadastrado'] = true;
            $query = ("insert into usuario(usuario,senha,email) values	('$user',md5('$senha_cadastro'),'$email');");
            mysqli_query($conexao, $query);
            header("location: ../index.php");
            exit();
        }else{
            $_SESSION['nao_cadastrado'] = true;
            header("location: ../index.php");
        }  
    }
    
}
