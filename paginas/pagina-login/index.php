<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login – EstagFlix</title>
    <link rel="stylesheet" href="style/estilos.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
</head>
<body>
    <div class="contenedor-form">
        <div class="toggle">
            <span> Criar conta</span>
        </div>
        
        <div class="formulario">
            <br/>
            <h1>Entrar</h1><br/>
            <br/>
            <form  action="php/login.php" method="POST">
                <input id="usuario" type="text" name="usuario" placeholder="Usuario" ><br/>
                <input id="senha" type="password" name="senha" placeholder="Senha" ><br/><br/><br/><br/>
                <input type="submit" value="OK"><br/>
            </form> 
                <?php
                if(isset($_SESSION['nao_autenticado'])):
                ?>
                <h1>ERRO</h1>
                <br/>
                <h2>usuário ou senha incorretos</h2>
                <br>
                <?php  
                unset($_SESSION['nao_autenticado']);
                endif;
                ?>
        </div>
        <div class="formulario">
            <h1>Crie sua conta</h1>
            <form action="#">
                <input type="text" placeholder="Usuario" required><br/>
                
                <input type="password" placeholder="Senha" required><br/>
                
                <input type="email" placeholder="Email" required><br/>
                
                <input type="text" placeholder="Telefone" required><br/>
                
                <input type="submit" value="Registrar"><br/>
            </form>
        </div>  
        
    </div>
    <script src="js/jquery-3.1.1.min.js"></script>    
    <script src="js/main.js"></script>

</body>
</html>

