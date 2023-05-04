<?php

require '/var/www/html/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];
$db_name = $_ENV['DB_NAME'];

define('DB_HOST', $host); 
define('DB_USER', $user);
define('DB_PASS', $pass);
define('DB_NAME', $db_name);

$conexao = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);


if (mysqli_connect_errno()) {
  die('Falha na conexão com o banco de dados: ' . mysqli_connect_error());
}

mysqli_set_charset($conexao, 'utf8mb4');

// Usar uma conexão SSL para criptografar a comunicação entre o aplicativo e o banco de dados
mysqli_ssl_set($conexao, 'caminho_para_certificado_ssl.pem', 'caminho_para_chave_ssl.pem', 'caminho_para_ca_ssl.pem', null, null);

?>