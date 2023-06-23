<?php
session_start();
include("../pagina-login/php/verifica-login.php");
include("../pagina-login/php/conexao-banco.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];

    $query = "DELETE FROM usuario WHERE usuario = '$usuario'";
    $resultado = mysqli_query($conexao, $query);

    if ($resultado) {
        echo "Usuário removido com sucesso!";
    } else {
        echo "Erro ao remover o usuário: " . mysqli_error($conexao);
    }

    mysqli_close($conexao);
}
?>
