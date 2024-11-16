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
    <title>Acervo</title>
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
            </ul>
            <a href="perfil.php" class="btn btn-secondary btn-lg active" id="perfil" role="button" aria-pressed="true">Perfil</a>
            <a href="sair.php" class="btn btn-secondary btn-lg active" id="sair" role="button" aria-pressed="true">Sair</a>
        </div>
    </nav>

    <div class="container" id="acervo">
        <aside class="filtro">
            <h5>Filtros</h5>
            <ul>
            <input type="checkbox" id="filtro1" name="filtro1">
            <label for="filtro1">Filtro 1</label><br>
            <input type="checkbox" id="filtro2" name="filtro2">
            <label for="filtro2">Filtro 2</label>
            <button>Aplicar filtro</button>
            </ul>
        </aside>

        <main class="conteudo">
            <div class="pesquisa">
                <input type="text" placeholder="Pesquisar...">
            </div>

            <div class="cards" id="cards-acervo">
                <div class="card column-md-3" style="width: 18rem;" id="livro-acervo">
                    <img class="card-img-top" src=".../100px180/" alt="Capa do livro">
                    <div class="card-body">
                        <h5 class="card-title">Título do livro</h5>
                        <p class="card-text">Nome do escritor</p>
                        <a href="livro.php" class="btn btn-primary">Ler</a>
                    </div>
                </div>
                <div class="card column-md-3" style="width: 18rem;" id="livro-acervo">
                    <img class="card-img-top" src=".../100px180/" alt="Capa do livro">
                    <div class="card-body">
                        <h5 class="card-title">Título do livro</h5>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                        </div>
                        <p> </p>
                        <a href="index.php" class="btn btn-primary">Continuar</a>
                    </div>
                </div>
                <div class="card column-md-3" style="width: 18rem;" id="livro-acervo">
                    <img class="card-img-top" src=".../100px180/" alt="Capa do livro">
                    <div class="card-body">
                        <h5 class="card-title">Título do livro</h5>
                        <p class="card-text">Nome do escritor</p>
                        <a href="index.php" class="btn btn-primary">Ler</a>
                    </div>
                </div>
                <div class="card column-md-3" style="width: 18rem;" id="livro-acervo">
                    <img class="card-img-top" src=".../100px180/" alt="Capa do livro">
                    <div class="card-body">
                        <h5 class="card-title">Título do livro</h5>
                        <p class="card-text">Nome do escritor</p>
                        <a href="index.php" class="btn btn-primary">Ler</a>
                    </div>
                </div>
                <div class="card column-md-3" style="width: 18rem;" id="livro-acervo">
                    <img class="card-img-top" src=".../100px180/" alt="Capa do livro">
                    <div class="card-body">
                        <h5 class="card-title">Título do livro</h5>
                        <p class="card-text">Nome do escritor</p>
                        <a href="index.php" class="btn btn-primary">Ler</a>
                    </div>
                </div>
                <div class="card column-md-3" style="width: 18rem;" id="livro-acervo">
                    <img class="card-img-top" src="https://cirandacultural.fbitsstatic.net/img/p/alice-no-pais-das-maravilhas-71924/258450.jpg?w=520&h=520&v=no-change&qs=ignore" alt="Capa do livro">
                    <div class="card-body">
                        <h5 class="card-title">Alice no país das maravilhas</h5>
                        <p class="card-text">Editora: sim</p>
                        <p class="card-text">Autor: ok</p>
                        <p> </p>
                        <a href="https://santatereza.go.gov.br/download/296/outros-livros-literarios/15385/alice-no-pais-das-maravilhas.pdf" class="btn btn-primary">Baixar</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <nav aria-label="Navegação de página exemplo" id="paginas">
        <ul class="pagination">
            <li class="page-item">
            <a class="page-link" href="#" aria-label="Anterior">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Anterior</span>
            </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
            <a class="page-link" href="#" aria-label="Próximo">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Próximo</span>
            </a>
          </li>
        </ul>
    </nav>
</body>

    <script src="app.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>