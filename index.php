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
    <title>Biblioteca</title>
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
        <span class="navbar-brand mb-0 h1">Home</span>
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
                <form class="search-container">
                  <input type="text" id="search-bar" placeholder="Busca">
                  <a href="#"></a>
                </form>
            <a href="perfil.php" class="btn btn-secondary btn-lg active" id="perfil" role="button" aria-pressed="true">Perfil</a>
            <a href="sair.php" class="btn btn-secondary btn-lg active" id="sair" role="button" aria-pressed="true">Sair</a>
        </div>
    </nav>

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" id="carousel">
                <img class="d-block w-100" src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8YmlibGlvdGVjYXxlbnwwfHwwfHx8MA%3D%3D" alt="Bem vindo">
                <div class="carousel-caption d-none d-md-block" id="textcar">
                    <h5>Bem vindo</h5>
                    <p>Seja bem vindo a nossa biblioteca digital!</p>
                </div>
            </div>
            <div class="carousel-item" id="carousel">
                <img class="d-block w-100" src="https://www.rbsdirect.com.br/filestore/4/5/7/3/2/8/4_607b3d2f9db96c0/4823754_d508394098f8f23.jpg?w=700" alt="Acervo">
                <div class="carousel-caption d-none d-md-block" id="textcar">
                    <h5>Acervo</h5>
                    <p>Em nosso acervo temos mais de 10000 livros de diferentes categorias.</p>
                </div>
            </div>
            <div class="carousel-item" id="carousel">
                <img class="d-block w-100" src="https://static.vecteezy.com/ti/vetor-gratis/p1/33084727-quadrinho-discurso-bolha-ilustracao-conjunto-do-dialogo-nuvem-mensagem-e-comunicacao-desenho-animado-conversa-balao-para-bate-papo-texto-esvaziar-esboco-elemento-rabisco-forma-vetor.jpg" alt="Comunidade">
                <div class="carousel-caption d-none d-md-block" id="textcar">
                    <h5>Comunidade</h5>
                    <p>Em nosso site temos uma área para a comunidade onde você pode interagir com outras pessoas.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Próximo</span>
        </a>
    </div>

    <h2>Continue lendo</h2>
    <section>
        <div id="cCarousel">
        <div class="arrow" id="prev">
            <i class="carousel-control-prev-icon"></i>
        </div>
        <div class="arrow" id="next">
            <i class="carousel-control-next-icon"></i>
        </div>
        <div id="carousel-vp">
        <div id="cCarousel-inner">
            <article class="cCarousel-item">
                <div class="card column-md-3" style="width: 18rem;" id="livro-index">
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
            </article>    
            <article class="cCarousel-item">
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
            </article>
            <article class="cCarousel-item">
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
            </article>
            <article class="cCarousel-item">
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
            </article>
            <article class="cCarousel-item">
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
            </article>
            <article class="cCarousel-item">
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
            </article>
            </div>
            </div>
            </div>
    </section>

    <h2>Sugestões</h2>
    <section>
        <div id="cCarousel1">
        <div class="arrow1" id="prev1">
            <i class="carousel-control-prev-icon"></i>
        </div>
        <div class="arrow1" id="next1">
            <i class="carousel-control-next-icon"></i>
        </div>
        <div id="carousel-vp1">
        <div id="cCarousel-inner1">
            <article class="cCarousel-item1">
                <div class="card column-md-3" style="width: 18rem;" id="livro-index">
                    <img class="card-img-top" src=".../100px180/" alt="Capa do livro">
                    <div class="card-body">
                        <h5 class="card-title">Título do livro</h5>
                        <p class="card-text">Nome do escritor</p>
                        <a href="index.php" class="btn btn-primary">Ler</a>
                    </div>
                </div>
            </article>
            <article class="cCarousel-item1">
                <div class="card column-md-3" style="width: 18rem;" id="livro-acervo">
                    <img class="card-img-top" src=".../100px180/" alt="Capa do livro">
                    <div class="card-body">
                        <h5 class="card-title">Título do livro</h5>
                        <p class="card-text">Nome do escritor</p>
                        <a href="index.php" class="btn btn-primary">Ler</a>
                    </div>
                </div>
            </article>
            <article class="cCarousel-item1">
                <div class="card column-md-3" style="width: 18rem;" id="livro-acervo">
                    <img class="card-img-top" src=".../100px180/" alt="Capa do livro">
                    <div class="card-body">
                        <h5 class="card-title">Título do livro</h5>
                        <p class="card-text">Nome do escritor</p>
                        <a href="index.php" class="btn btn-primary">Ler</a>
                    </div>
                </div>
            </article>
            <article class="cCarousel-item1">
                <div class="card column-md-3" style="width: 18rem;" id="livro-acervo">
                    <img class="card-img-top" src=".../100px180/" alt="Capa do livro">
                    <div class="card-body">
                        <h5 class="card-title">Título do livro</h5>
                        <p class="card-text">Nome do escritor</p>
                        <a href="index.php" class="btn btn-primary">Ler</a>
                    </div>
                </div>
            </article>
            <article class="cCarousel-item1">
                <div class="card column-md-3" style="width: 18rem;" id="livro-acervo">
                    <img class="card-img-top" src=".../100px180/" alt="Capa do livro">
                    <div class="card-body">
                        <h5 class="card-title">Título do livro</h5>
                        <p class="card-text">Nome do escritor</p>
                        <a href="index.php" class="btn btn-primary">Ler</a>
                    </div>
                </div>
            </article>
            <article class="cCarousel-item1">
                <div class="card column-md-3" style="width: 18rem;" id="livro-acervo">
                    <img class="card-img-top" src=".../100px180/" alt="Capa do livro">
                    <div class="card-body">
                        <h5 class="card-title">Título do livro</h5>
                        <p class="card-text">Nome do escritor</p>
                        <a href="index.php" class="btn btn-primary">Ler</a>
                    </div>
                </div>
            </article>
            </div>
            </div>
        </div>
    </section>

    <h2>Principais obras</h2>
    <section>
        <div id="cCarousel2">
        <div class="arrow2" id="prev2">
            <i class="carousel-control-prev-icon"></i>
        </div>
        <div class="arrow2" id="next2">
            <i class="carousel-control-next-icon"></i>
        </div>
        <div id="carousel-vp2">
        <div id="cCarousel-inner2">
            <article class="cCarousel-item2">
                <div class="card column-md-3" style="width: 18rem;" id="livro-index">
                    <img class="card-img-top" src=".../100px180/" alt="Capa do livro">
                    <div class="card-body">
                        <h5 class="card-title">Título do livro</h5>
                        <p class="card-text">Nome do escritor</p>
                        <a href="index.php" class="btn btn-primary">Ler</a>
                    </div>
                </div>
            </article>
            <article class="cCarousel-item2">
                <div class="card column-md-3" style="width: 18rem;" id="livro-acervo">
                    <img class="card-img-top" src=".../100px180/" alt="Capa do livro">
                    <div class="card-body">
                        <h5 class="card-title">Título do livro</h5>
                        <p class="card-text">Nome do escritor</p>
                        <a href="index.php" class="btn btn-primary">Ler</a>
                    </div>
                </div>
            </article>
            <article class="cCarousel-item2">
                <div class="card column-md-3" style="width: 18rem;" id="livro-acervo">
                    <img class="card-img-top" src=".../100px180/" alt="Capa do livro">
                    <div class="card-body">
                        <h5 class="card-title">Título do livro</h5>
                        <p class="card-text">Nome do escritor</p>
                        <a href="index.php" class="btn btn-primary">Ler</a>
                    </div>
                </div>
            </article>
            <article class="cCarousel-item2">
                <div class="card column-md-3" style="width: 18rem;" id="livro-acervo">
                    <img class="card-img-top" src=".../100px180/" alt="Capa do livro">
                    <div class="card-body">
                        <h5 class="card-title">Título do livro</h5>
                        <p class="card-text">Nome do escritor</p>
                        <a href="index.php" class="btn btn-primary">Ler</a>
                    </div>
                </div>
            </article>
            <article class="cCarousel-item2">
                <div class="card column-md-3" style="width: 18rem;" id="livro-acervo">
                    <img class="card-img-top" src=".../100px180/" alt="Capa do livro">
                    <div class="card-body">
                        <h5 class="card-title">Título do livro</h5>
                        <p class="card-text">Nome do escritor</p>
                        <a href="index.php" class="btn btn-primary">Ler</a>
                    </div>
                </div>
            </article>
            <article class="cCarousel-item2">
                <div class="card column-md-3" style="width: 18rem;" id="livro-acervo">
                    <img class="card-img-top" src=".../100px180/" alt="Capa do livro">
                    <div class="card-body">
                        <h5 class="card-title">Título do livro</h5>
                        <p class="card-text">Nome do escritor</p>
                        <a href="index.php" class="btn btn-primary">Ler</a>
                    </div>
                </div>
            </article>
            </div>
            </div>
        </div>
    </section>

    <h3> </h3>

    <div class="jumbotron jumbotron-fluid" id="jumbotron">
        <div class="container">
            <h2 class="display-4" id="nosh">Sobre nós</h2>
            <p class="lead" id="nosp">Nós somos uma empresa que bucamos oferecer livros de qualidade para todos.</p>
        </div>
    </div>

    <script src="app.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>