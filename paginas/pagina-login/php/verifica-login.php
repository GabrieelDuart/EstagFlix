<?php

session_start();

if(!$_SESSION['usuario']) {
    header("location: ../pagina-login/index.php");
    exit();
}
