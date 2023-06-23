<?php
session_start();
include ("../pagina-login/php/verifica-login.php")
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/main.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

    <!--responsividade-->
    <link rel="stylesheet" href="style/responsive.css">

    <!--owl css-->
    <link rel="stylesheet" href="style/owl/owl.carousel.min.css">
    <link rel="stylesheet" href="style/owl/owl.theme.default.min.css">

    <title>Início – EstagFlix</title>
</head>
<body>
</body>
    <header><br>
        <div class="container">
            <img src="../../estagflix.png" alt="" />
            <nav>
                <a href="../pagina-filmes/index.php"><?php echo $_SESSION['usuario'];?></a>
                <a href="../pagina-adm/index.php"><?php echo $_SESSION['usuario_adm'];?></a> 
                <a href="../pagina-login/php/logout.php">Sair</a>
            </nav>
        </div> 
    </header><br>

    <main>
        <div class="filme-principal">
            <div class="container">
                <h3 class="titulo">HOUSE OF CARDS</h3>
                <p class="descricao">Nada pode impedir o político sem escrúpulos Frank Underwood de conquistar Washington. Assista agora a nova temporada de House of Cards que está imperdível.</p>
                <div class="botoes">
                    <button role="button" class="botao">
                        <i class="fas fa-play"></i>
                        ASSISTIR AGORA
                    </button>
                    <button role="button" class="botao">
                        <i class="fas fa-info-circle"></i>
                        MAIS INFORMAÇÕES
                    </button>
                </div>
            </div>
        </div>
    </main>

    <div class="carrosel-filmes">
        <div class="owl-carousel owl-theme">
                <div class="item">
                    <img class="box-filme" src="img/mini1.jpg" alt="" srcset="">
                </div>
                <div class="item">
                    <img class="box-filme" src="img/mini2.jpg" alt="" srcset="">
                </div>
                <div class="item">
                    <img class="box-filme" src="img/mini3.jpg" alt="" srcset="">
                </div>
                <div class="item">
                    <img class="box-filme" src="img/mini4.jpg" alt="" srcset="">
                </div>
                <div class="item">
                    <img class="box-filme" src="img/mini5.jpg" alt="" srcset="">
                </div>
                <div class="item">
                    <img class="box-filme" src="img/mini6.jpg" alt="" srcset="">
                </div>
                <div class="item">
                    <img class="box-filme" src="img/mini7.jpg" alt="" srcset="">
                </div>
                <div class="item">
                    <img class="box-filme" src="img/mini8.jpg" alt="" srcset="">
                </div>
                <div class="item">
                    <img class="box-filme" src="img/mini9.jpg" alt="" srcset="">
                </div>
                <div class="item">
                    <img class="box-filme" src="img/mini10.jpg" alt="" srcset=""> 
                </div> 
        </div>
    </div>
   
    <div class="container">
        <h1>Em alta</h1><br>
    </div>

    <div class="carrosel-filmes">
        <div class="owl-carousel owl-theme">
                <div class="item">
                    <img class="box-filme"  src="img/img-2.jpg" alt="" srcset="">
                    
                </div>
                <div class="item">
                    <img class="box-filme" src="img/img-3.jpg" alt="" srcset="">
                </div>
                <div class="item">
                    <img class="box-filme" src="img/img-4.jpg" alt="" srcset="">
                </div>
                <div class="item">
                    <img class="box-filme" src="img/img-5.jpg" alt="" srcset="">
                </div>
                <div class="item">
                    <img class="box-filme" src="img/img-6.jpg" alt="" srcset="">
                </div>
                <div class="item">
                    <img class="box-filme" src="img/img-7.jpg" alt="" srcset="">
                </div>
                <div class="item">
                    <img class="box-filme" src="img/img-8.jpg" alt="" srcset="">
                </div>
                <div class="item">
                    <img class="box-filme" src="img/img-9.jpg" alt="" srcset="">
                </div>
                <div class="item">
                    <img class="box-filme" src="img/img-10.jpg" alt="" srcset="">
                </div>
                <div class="item">
                    <img class="box-filme" src="img/img-11.jpg" alt="" srcset="">
                </div>
        </div>
    </div>
    
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/setup.js"></script>

</body>
</html>

<php></php>