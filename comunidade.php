<?php

    session_start();
    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true))
    {
        unset($_SESSION['emailUsuario']);
        unset($_SESSION['senha']);
        header('Location: login.php');
    }
    $logado = $_SESSION['emailUsuario'];
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Comunidade</title>
    <link rel="shortcut icon" type="imagex/png" href="icone.ico">
    <style>
        #sair
        {
            background-color: red;
            color: white;
            border-radius: 10px;
        }
    </style>
</head>
<body id="background">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">Biblioteca</span>
        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(página atual)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="acervo.php">Acervo <span class="sr-only">(página atual)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="comunidade.php">Comunidade <span class="sr-only">(página atual)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="faq.php">Contato <span class="sr-only">(página atual)</span></a>
                </li>
            </ul>
                <form class="search-container">
                  <input type="text" id="search-bar" placeholder="Busca">
                  <a href="#"></a>
                </form>
            <a href="perfil.php" class="btn btn-secondary btn-lg active" id="perfil" role="button" aria-pressed="true">Perfil</a>
            <a href="sair.php" class="btn btn-secondary btn-lg active" id="sair" role="button" aria-pressed="true">Sair</a>
        </div>
    </nav>

    <h1 id="comu">Comunidades</h1>
    <div class="container" id="comunidade">
        <main class="conteudo">
            <div class="pesquisa" id="pescomu">
                <input type="text" placeholder="Pesquisar...">
            </div>

            <div class="cards" id="comus">
                <div class="card column-md-3" style="width: 18rem;" id="comuni">
                    <img class="card-img-top" src=".../100px180/" alt="Capa do livro">
                    <div class="card-body">
                        <h5 class="card-title">Nome da comunidade</h5>
                        <a href="index.php" class="btn btn-primary">Entrar</a>
                    </div>
                </div>
                <div class="card column-md-3" style="width: 18rem;" id="comuni">
                    <img class="card-img-top" src=".../100px180/" alt="Capa do livro">
                    <div class="card-body">
                        <h5 class="card-title">Nome da comunidade</h5>
                        <a href="index.php" class="btn btn-primary">Entrar</a>
                    </div>
                </div>
                <div class="card column-md-3" style="width: 18rem;" id="comuni">
                    <img class="card-img-top" src=".../100px180/" alt="Capa do livro">
                    <div class="card-body">
                        <h5 class="card-title">Nome da comunidade</h5>
                        <a href="index.php" class="btn btn-primary">Entrar</a>
                    </div>
                </div>
                <div class="card column-md-3" style="width: 18rem;" id="comuni">
                    <img class="card-img-top" src=".../100px180/" alt="Capa do livro">
                    <div class="card-body">
                        <h5 class="card-title">Nome da comunidade</h5>
                        <a href="index.php" class="btn btn-primary">Entrar</a>
                    </div>
                </div>
                <div class="card column-md-3" style="width: 18rem;" id="comuni">
                    <img class="card-img-top" src=".../100px180/" alt="Capa do livro">
                    <div class="card-body">
                        <h5 class="card-title">Nome da comunidade</h5>
                        <a href="index.php" class="btn btn-primary">Entrar</a>
                    </div>
                </div>
                <div class="card column-md-3" style="width: 18rem;" id="comuni">
                    <img class="card-img-top" src="https://cirandacultural.fbitsstatic.net/img/p/alice-no-pais-das-maravilhas-71924/258450.jpg?w=520&h=520&v=no-change&qs=ignore" alt="Capa do livro">
                    <div class="card-body">
                        <h5 class="card-title">Alice no país das maravilhas</h5>
                        <a href="index.php" class="btn btn-primary">Entrar</a>
                    </div>
                </div>
            </div>
        </main>

    <script src="app.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>