<?php
session_start();

// Verificar se a sessão está ativa
if ((!isset($_SESSION['emailUsuario']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['emailUsuario']);
    unset($_SESSION['senha']);
    header('Location: login.php');
    exit();
}
$logado = $_SESSION['emailUsuario']; // Email do usuário logado

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $acao = $_POST['acao'] ?? '';
    $livro_id = intval($_POST['livro_id'] ?? 0);

    if ($livro_id <= 0) {
        die("Livro inválido.");
    }

    // Verificar se já existe um registro na tabela `usuarios_livros`
    $query = "SELECT id_status, status FROM usuarios_livros WHERE id_usuario = ? AND id_livro = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("ii", $id_usuario, $livro_id);
    $stmt->execute();
    $stmt->bind_result($registro_id, $status_atual);
    $stmt->fetch();
    $stmt->close();

    if ($acao === 'lendo') {
        if ($registro_id) {
            // Atualizar o status para "lendo" se o registro já existir
            $query = "UPDATE usuarios_livros SET status = ? WHERE id_usuario = ? AND id_livro = ?";
            $stmt = $conexao->prepare($query);
            $status = 'lendo';
            $stmt->bind_param("sii", $status, $id_usuario, $livro_id);
            $stmt->execute();
        } else {
            // Inserir um novo registro se não existir
            $query = "INSERT INTO usuarios_livros (id_usuario, id_livro, status) VALUES (?, ?, 'lendo')";
            $stmt = $conexao->prepare($query);
            $stmt->bind_param("ii", $id_usuario, $livro_id);
            $stmt->execute();

             // Incrementar o contador de acessos do livro na tabela `livros`
        $query = "UPDATE livros SET acesso = acesso + 1 WHERE id_livro = ?";
        $stmt = $conexao->prepare($query);
        $stmt->bind_param("i", $livro_id);
        $stmt->execute();
        }
    } elseif ($acao === 'finalizado') {
        if ($registro_id) {
            // Atualizar o status para "finalizado" se o registro já existir
            $query = "UPDATE usuarios_livros SET status = ? WHERE id_usuario = ? AND id_livro = ?";
            $stmt = $conexao->prepare($query);
            $status = 'finalizado';
            $stmt->bind_param("sii", $status, $id_usuario, $livro_id);
            $stmt->execute();
        } else {
            // Inserir um novo registro se não existir
            $query = "INSERT INTO usuarios_livros (id_usuario, id_livro, status) VALUES (?, ?, 'finalizado')";
            $stmt = $conexao->prepare($query);
            $stmt->bind_param("ii", $id_usuario, $livro_id);
            $stmt->execute();
        }
    }

    if ($stmt->execute()) {
        echo "<script>alert('Status atualizado com sucesso!'); window.location.href = '1984.php?id={$livro_id}';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar status.'); window.location.href = '1984.php?id={$livro_id}';</script>";
    }
    $stmt->close();
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
    
    <div class="container" id="acervo">
        <div class="card"  id="livro">
            <img class="card-img-top" src="https://m.media-amazon.com/images/I/61t0bwt1s3L._AC_UF1000,1000_QL80_.jpg" alt="Capa do livro">
            <div class="card-body">
                <a href="https://culturadefato.com.br/downloads/artes_e_literatura/2020/1984-george-owell.pdf" class="btn btn-primary">Ler</a>
            </div>
        </div>
        
        <div id="sinopse">
            <h1>1984</h1>
            <h5>Nome do autor: George Orwell</h5>
            <h5>Data de lançamento: 1949</h5>
            <h5>Gênero: Distopia, Ficção cientifica, Política, Sociologia</h5>
            <h5>Sinopse do livro</h5>
            <p>Publicado em 1949, 1984 é um romance distópico ambientado em um futuro sombrio, onde o mundo é controlado por regimes totalitários. A história se passa na fictícia Oceânia, governada pelo Partido, liderado pelo enigmático e onipresente Grande Irmão (Big Brother). O Partido controla todos os aspectos da vida, monitorando os cidadãos constantemente através de teletelas e suprimindo qualquer forma de pensamento ou comportamento que ameace sua autoridade.</p>
            <p>O protagonista, Winston Smith, trabalha no Ministério da Verdade, onde altera documentos históricos para alinhar o passado à narrativa do Partido. Apesar de ser um membro do Partido, Winston sente repulsa pelo regime opressor e começa a questionar sua lealdade. Ele se envolve secretamente com Julia, uma colega que também se opõe ao Partido, e juntos buscam formas de resistir e viver uma vida livre.</p>
            <p>No entanto, a vigilância do Partido é implacável, e Winston descobre que escapar do controle totalitário é quase impossível. A obra explora temas como manipulação da verdade, censura, vigilância constante e a luta pela liberdade individual em um mundo onde o poder absoluto corrompe tudo. 1984 é uma poderosa reflexão sobre os perigos do autoritarismo e continua relevante até hoje.</p>
            <div class="d-flex justify-content mt-3">
                <form method="POST" action="">
                    <input type="hidden" name="acao" value="lendo">
                    <input type="hidden" name="livro_id" value="<?php echo $_GET['id']; ?>">
                    <button type="submit" class="btn btn-success mr-2">Estou lendo</button>
                </form>
                <form method="POST" action="">
                    <input type="hidden" name="acao" value="finalizado">
                    <input type="hidden" name="livro_id" value="<?php echo $_GET['id']; ?>">
                    <button type="submit" class="btn btn-primary">Finalizado</button>
                </form>
            </div>

        </div>
    </div>
    <script src="app.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>