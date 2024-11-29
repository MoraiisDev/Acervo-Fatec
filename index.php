<?php
    session_start();
    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true))
    {
        unset($_SESSION['emailUsuario']);
        unset($_SESSION['senha']);
        header('Location: login.php');
    }
    $logado = $_SESSION['emailUsuario'];
    


    // Conexão com o banco de dados
include_once('config.php'); 



// Consulta para verificar o ID do usuário baseado no email
$query = "SELECT id FROM usuarios WHERE usuario = ? OR email = ?";
$stmt = $conexao->prepare($query);
$stmt->bind_param("ss", $logado, $logado);
$stmt->execute();
$stmt->bind_result($idUsuario);
$stmt->fetch();
$stmt->close();
// Após a autenticação bem-sucedida
$_SESSION['idUsuario'] = $idUsuario; // Certifique-se de que $idUsuario contém o valor correto

// Verifica se o ID do usuário está armazenado corretamente na sessão
if (!isset($_SESSION['idUsuario'])) {
    die("Erro: ID do usuário não encontrado na sessão.");
}

$id_usuario = $_SESSION['idUsuario']; // Obtém o ID do usuário

// Inicialize as variáveis como arrays vazios
$lendo = [];
$finalizado = [];

// Consulta para obter os livros 'lendo'
$query = "SELECT id_livro FROM usuarios_livros WHERE id_usuario = ? AND status = 'lendo'";
$stmt = $conexao->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

// Armazenar os IDs dos livros 'lendo' em um array
$lendol = [];
while ($livro = $result->fetch_assoc()) {
    $lendol[] = $livro['id_livro']; // Armazenando o id_livro no array
}

// Se houver livros 'lendo', vamos usar o implode() para passar os IDs na consulta seguinte
if (count($lendol) > 0) {
    $query = "SELECT * FROM livros WHERE id_livro IN (" . implode(",", $lendol) . ")";
    $stmt = $conexao->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($livrol = $result->fetch_assoc()) {
        $lendo[] = $livrol;
    }
}

// Consulta para obter os livros 'finalizados'
$query = "SELECT id_livro FROM usuarios_livros WHERE id_usuario = ? AND status = 'finalizado'";
$stmt = $conexao->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

// Armazenar os IDs dos livros 'finalizados' em um array
$finalizadol = [];
while ($livro = $result->fetch_assoc()) {
    $finalizadol[] = $livro['id_livro']; // Armazenando o id_livro no array
}

// Se houver livros 'finalizados', vamos usar o implode() para passar os IDs na consulta seguinte
if (count($finalizadol) > 0) {
    $query = "SELECT * FROM livros WHERE id_livro IN (" . implode(",", $finalizadol) . ")";
    $stmt = $conexao->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($livrof = $result->fetch_assoc()) {
        $finalizado[] = $livrof;
    }
}


    $query = "SELECT * FROM livros WHERE acesso > 0 ORDER BY acesso DESC LIMIT 4";
    $stmt = $conexao->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

// Processa os resultados
$principal = [];
while ($livrop = $result->fetch_assoc()) {
    $principal[] = $livrop;
}

$query = "SELECT * FROM livros";
$stmt = $conexao->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$todosLivros = [];
while ($livro = $result->fetch_assoc()) {
    $todosLivros[] = $livro;
}

function verificarGeneros($genero1, $genero2) {
    // Explode os gêneros separados por vírgulas em arrays
    $generos1 = array_map('trim', explode(',', strtolower($genero1)));
    $generos2 = array_map('trim', explode(',', strtolower($genero2)));

    // Verifica se há interseção entre os arrays de gêneros
    return count(array_intersect($generos1, $generos2)) > 0;
}


function encontrarSugestoes($livro, $todosLivros) {
    $sugestoes = [];

    if (empty($livro)) {
        return $sugestoes;  // Retorna vazio se não houver livro fornecido
    }

    foreach ($todosLivros as $livroSugestao) {
        // Comparar título (usando similaridade), autor e gêneros
        $similaridadeTitulo = 0;
        similar_text(strtolower($livro['titulo']), strtolower($livroSugestao['titulo']), $similaridadeTitulo);

        // Adicionar livro à lista de sugestões se ele for semelhante
        if (($livro['id_livro'] !== $livroSugestao['id_livro']) && 
            ($similaridadeTitulo > 70 ||  // Títulos com mais de 70% de similaridade
             strtolower($livroSugestao['nome_autor']) === strtolower($livro['nome_autor']) || 
             verificarGeneros($livro['genero'], $livroSugestao['genero']))) {
            $sugestoes[] = $livroSugestao;
        }

        // Limitar a 10 sugestões
        if (count($sugestoes) >= 10) {
            break; // Sai do loop quando atingir 10 sugestões
        }
    }

    return $sugestoes;
}


// Combine os livros "lendo" e "finalizados" para gerar sugestões com base em todos os livros
$livrosParaSugestoes = array_merge($lendo, $finalizado);

// Verifique se há livros para gerar sugestões
$sugestoes = [];
if (!empty($livrosParaSugestoes)) {
    foreach ($livrosParaSugestoes as $livro) {
        $novasSugestoes = encontrarSugestoes($livro, $todosLivros);
        foreach ($novasSugestoes as $sugestao) {
            if (!in_array($sugestao, $sugestoes)) {
                $sugestoes[] = $sugestao;
            }
        }
        if (count($sugestoes) >= 10) {
            break;
        }
    }
}



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
                <form action="acervo.php" method="GET">
                    <input type="text" name="pesquisa" placeholder="Pesquise por título ou autor" required>
                    <button type="submit">Pesquisar</button>
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

    <?php if ($lendo): ?>
    <h2>Continue lendo</h2>
    <section id="carouseli">
    <div id="cCarousel">
        <?php if (count($lendo) > 5): ?>
            <div class="arrow" id="prev">
            <i class="carousel-control-prev-icon"></i>
        </div>
        <div class="arrow" id="next">
            <i class="carousel-control-next-icon"></i>
        </div>
        <?php endif; ?>
    <div id="carousel-vp">
    <div id="cCarousel-inner">
            <?php foreach ($lendo as $livrol): ?>
                <article class="cCarousel-item">
                <div class="card column-md-3" style="width: 18rem;" id="livro-index">
                    <img src="<?= $livrol['capa'] ?>" alt="<?= $livrol['titulo'] ?>" id="capa-livro">
                    <div class="card-body">
                        <h5 class="card-title"><?= $livrol['titulo'] ?></h5>
                        <p class="card-text">Autor: <?= $livrol['nome_autor'] ?></p>
                        <a href="<?= $livrol['titulo'] ?>.php?id=<?= $livrol['id_livro'] ?>" class="btn btn-primary">Continuar</a>
                    </div>
                </div>
            </article> 
            <?php endforeach; ?>
            </div>
            </div>
            </div>
            </section>
    <?php endif; ?>


    
    <?php if (!empty($sugestoes)): ?> 
<h2>Sugestões</h2>
<section id="carouseli">
    <div id="cCarousel1">
<?php if (count($sugestoes) > 5): ?>
                    <div class="arrow1" id="prev1">
                        <i class="carousel-control-prev-icon"></i>
                    </div>
                    <div class="arrow1" id="next1">
                        <i class="carousel-control-next-icon"></i>
                    </div>
                <?php endif; ?>
        <div id="carousel-vp1">
            <div id="cCarousel-inner1">
                <!-- Exibição das sugestões -->
                <?php foreach ($sugestoes as $livroSugestao): ?>
                    <article class="cCarousel-item">
                        <div class="card column-md-3" style="width: 18rem;" id="livro-index">
                            <img src="<?= $livroSugestao['capa'] ?>" alt="<?= $livroSugestao['titulo'] ?>" id="capa-livro">
                            <div class="card-body">
                                <h5 class="card-title"><?= $livroSugestao['titulo'] ?></h5>
                                <p class="card-text">Autor: <?= $livroSugestao['nome_autor'] ?></p>
                                <a href="<?= $livroSugestao['titulo'] ?>.php?id=<?= $livroSugestao['id_livro'] ?>" class="btn btn-primary">Ler</a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>



    <?php if ($principal): ?>
    <h2>Principais obras</h2>
    <section id="carouseli">
    <div id="cCarousel2">
        <?php if (count($principal) > 5): ?>
            <div class="arrow2" id="prev2">
            <i class="carousel-control-prev-icon"></i>
        </div>
        <div class="arrow2" id="next2">
            <i class="carousel-control-next-icon"></i>
        </div>
        <?php endif; ?>
    <div id="carousel-vp2">
    <div id="cCarousel-inner2">
            <?php foreach ($principal as $livrop): ?>
                <article class="cCarousel-item">
                <div class="card column-md-3" style="width: 18rem;" id="livro-index">
                    <img src="<?= $livrop['capa'] ?>" alt="<?= $livrop['titulo'] ?>" id="capa-livro">
                    <div class="card-body">
                        <h5 class="card-title"><?= $livrop['titulo'] ?></h5>
                        <p class="card-text">Autor: <?= $livrop['nome_autor'] ?></p>
                        <a href="<?= $livrop['titulo'] ?>.php?id=<?= $livrop['id_livro'] ?>" class="btn btn-primary">Ler</a>
                    </div>
                </div>
            </article> 
            <?php endforeach; ?>
            </div>
            </div>
            </div>
            </section>
    <?php endif; ?>

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
<?php
$stmt->close();
$conexao->close();
?>
