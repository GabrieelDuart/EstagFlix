<?php
session_start();
include("../pagina-login/php/verifica-login.php");
include("../pagina-login/php/conexao-banco.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $permAdm = $_POST["permAdm"];

    $query = "UPDATE usuario SET perm_adm = '$permAdm' WHERE usuario = '$usuario'";
    $resultado = mysqli_query($conexao, $query);

    if ($resultado) {
        echo "Permissão atualizada com sucesso!";
    } else {
        echo "Erro ao atualizar a permissão: " . mysqli_error($conexao);
    }

    mysqli_close($conexao);
}
?>
