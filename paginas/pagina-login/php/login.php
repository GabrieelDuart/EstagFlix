<?php
session_start();
include("verifica-login.php");
include("conexao-banco.php");

if(empty($_POST['usuario']) || empty($_POST['senha'])){
    header("location: ../index.html");
    exit();
}

$usuario = mysqli_real_escape_string($conexao, $_POST['usuario'] ?? null);
$senha = mysqli_real_escape_string($conexao, $_POST['senha'] ?? null);


$query = ("select usuario from usuario where usuario = '$usuario' and senha = md5('$senha')");


$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

if($row == 1) {
    $_SESSION["usuario"] = $usuario;
    header("location: ../../pagina-filmes/index.php ");
    exit();
}else{
    header("location: ../index.html");
    exit();
}
