<?php
session_start();
include("conexao-banco.php");

if(empty($_POST['usuario']) || empty($_POST['senha'])){
    header("location: ../index.php");
    exit();
}

$usuario = mysqli_real_escape_string($conexao, $_POST['usuario'] ?? null);
$senha = mysqli_real_escape_string($conexao, $_POST['senha'] ?? null);


$query = ("select usuario from usuario where usuario = '$usuario' and senha = md5('$senha')");


$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

if($row == 1) {
    $_SESSION['usuario'] = $usuario;

    $query = ("SELECT perm_adm FROM usuario WHERE usuario = '$usuario';");
    $result = mysqli_query($conexao, $query);
    $row = mysqli_fetch_assoc($result); 

    if ($row['perm_adm'] == 1) { 
        $_SESSION['usuario_adm'] = true;
        $_SESSION['usuario_adm'] = "Gerenciamento";
    }
    header("location: ../../pagina-filmes/index.php ");
    exit();
}else{
    $_SESSION['nao_autenticado'] = true;
    header("location: ../index.php");
    exit();
}
