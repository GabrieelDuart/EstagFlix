<?php

#nao apagar
##//$host = getenv('HOST_MYSQL');
##//$user = getenv('DB_USER');
##//$pass = getenv('DB_PASS');
##//$db_name = getenv('DB_NAME');

define('DB_HOST', 'localhost'); 
define('DB_USER', 'root');
define('DB_PASS', 'vista');
define('DB_NAME', 'login');

$conexao = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);



if (mysqli_connect_errno()) {
  die('Falha na conexão com o banco de dados: ' . mysqli_connect_error());
}

mysqli_set_charset($conexao, 'utf8mb4');

// Usar uma conexão SSL para criptografar a comunicação entre o aplicativo e o banco de dados
mysqli_ssl_set($conexao, 'caminho_para_certificado_ssl.pem', 'caminho_para_chave_ssl.pem', 'caminho_para_ca_ssl.pem', null, null);

?>