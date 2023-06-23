<?php
session_start();
include ("../pagina-login/php/verifica-login.php");
include("../pagina-login/php/conexao-banco.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/main.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

    <title >Início – EstagFlix</title>
</head>
<body>
</body>
    <header><br>
        <div class="container">
            <h2 class="logo">EstagFlix</h2>
            <nav>
                <a href="../pagina-filmes/index.php" class="link-branco"><?php echo $_SESSION['usuario'];?></a>
                <a href="../pagina-login/php/logout.php" class="link-branco">Sair</a>

            </nav>
        </div> 
    </header><br>
</body>
<style>

</style>
<body>
    <h1>Gerenciamento de Usuários</h1><br>
    <table>
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Permissão</th>
            <th>Admin</th> 
        </tr>

        <?php

        $query = "SELECT usuario, email, perm_adm FROM usuario";
        $result = mysqli_query($conexao, $query);

        if (mysqli_num_rows($result) > 0) {
        
            while ($row = mysqli_fetch_assoc($result)) {
                
                $isAdmin = $row['perm_adm'] == 1 ? 'checked' : '';

                if($row['perm_adm'] == 1){
                    $row['perm_adm'] = "ADM";
                }else{
                    $row['perm_adm'] = "Padrão";
                }

                echo "<tr>";
                echo "<td>" . $row['usuario'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['perm_adm'] . "</td>";
                echo "<td><label class='custom-checkbox'><input type='checkbox' $isAdmin><span class='checkmark'></span></label></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Nenhum usuário encontrado.</td></tr>";
        }

        mysqli_close($conexao);
        ?>

    </table>
</body>
</html>