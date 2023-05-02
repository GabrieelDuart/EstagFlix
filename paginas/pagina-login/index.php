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
                <?php
                if(isset($_SESSION['cadastrado'])):
                ?>
                <h1>Sucesso !!!</h1>
                <br/>
                <h2>usuário cadastrado</h2>
                <br>
                <?php  
                unset($_SESSION['cadastrado']);
                endif;
                ?>
                <?php
                if(isset($_SESSION['nao_cadastrado'])):
                ?>
                <h1>ERRO</h1>
                <br/>
                <h2>Senhas não coincidem</h2>
                <br>
                <?php  
                unset($_SESSION['nao_cadastrado']);
                endif;
                ?>
                 <?php
                if(isset($_SESSION['usuario_existente'])):
                ?>
                <h1>ERRO</h1>
                <br/>
                <h2>Usuario já existe</h2>
                <br>
                <?php  
                unset($_SESSION['usuario_existente']);
                endif;
                ?>
                   <?php
                if(isset($_SESSION['email_existente'])):
                ?>
                <h1>ERRO</h1>
                <br/>
                <h2>Email já existe</h2>
                <br>
                <?php  
                unset($_SESSION['email_existente']);
                endif;
                ?>
        </div>
        <div class="formulario">
            <h1>Crie sua conta</h1>
            <form action="php/cria-login.php" method="POST">

                <input id="user" type="text" name="user" placeholder="Usuario" required><br/>
                
                <input id="senha_cadastro" type="password" name="senha_cadastro" placeholder="Senha" required><br/>

                <input id="c_senha_cadastro" type="password" name="c_senha_cadastro" placeholder="Confirme sua senha" required><br/>
                
                <input id="email" type="email" placeholder="Email" name="email" equired><br/>
                
                <input type="submit" value="Registrar"><br/>
            </form>
            
        </div>  
        
    </div>
    <script src="js/jquery-3.1.1.min.js"></script>    
    <script src="js/main.js"></script>

</body>
</html>

