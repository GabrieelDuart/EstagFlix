<?php
session_start();
include("../pagina-login/php/verifica-login.php");
include("../pagina-login/php/conexao-banco.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/main.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

    <title>Início – EstagFlix</title>
</head>
<body>
<header><br>
    <div class="container">
        <h2 class="logo">EstagFlix</h2>
        <nav>
            <a href="../pagina-filmes/index.php" class="link-branco"><?php echo $_SESSION['usuario']; ?></a>
            <a href="../pagina-login/php/logout.php" class="link-branco">Sair</a>
        </nav>
    </div>
</header><br>

<h1>Gerenciamento de Usuários</h1><br>
<table>
    <tr>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Admin</th>
        <th>Usuário</th>
    </tr>

    <?php

    $query = "SELECT usuario, email, perm_adm FROM usuario";
    $result = mysqli_query($conexao, $query);

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

            $isAdmin = $row['perm_adm'] == 1 ? 'checked' : '';

            echo "<tr>";
            echo "<td>" . $row['usuario'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td><label class='custom-checkbox'><input type='checkbox' class='chk-perm-adm' data-usuario='" . $row['usuario'] . "' $isAdmin><span class='checkmark'></span></label></td>";
            
            if ($row['perm_adm'] != 1) {
                echo "<td><button class='btn-remover-usuario' data-usuario='" . $row['usuario'] . "'>Remover</button></td>";
            } else {
                echo "<td><button class='btn-remover-usuario' data-usuario='" . $row['usuario'] . "' disabled>Remover</button></td>";
            }
            
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Nenhum usuário encontrado.</td></tr>";
    }

    mysqli_close($conexao);
    ?>

</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $(".chk-perm-adm").change(function () {
            var usuario = $(this).data("usuario");
            var permAdm = $(this).is(":checked") ? 1 : 0;

            $.ajax({
                url: "atualizar-perm-adm.php",
                type: "POST",
                data: {usuario: usuario, permAdm: permAdm},
                success: function (response) {
                    alert("Permissão atualizada para o usuário: " + usuario);
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });

        $(".btn-remover-usuario").click(function () {
            var usuario = $(this).data("usuario");
            
            if ($(this).is(":disabled")) {
                alert("Não é possível remover o usuário administrador.");
                return;
            }

            if (confirm("Deseja remover o usuário: " + usuario + "?")) {
                $.ajax({
                    url: "remover-usuario.php",
                    type: "POST",
                    data: {usuario: usuario},
                    success: function (response) {
                        alert("Usuário removido: " + usuario);
                        location.reload(); // Recarrega a página após a remoção do usuário
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    });
</script>
</body>
</html>
