<?php
session_start();
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
  unset($_SESSION['emailUsuario']);
  unset($_SESSION['senha']);
  header('Location: login.php');
}
$logado = $_SESSION['emailUsuario'];
?>

<?php
$status = null; // Define o status como nulo inicialmente

// Lógica para processar o formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once('config.php'); // Conexão com o banco

    // Captura de dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $assunto = $_POST['assunto'];
    $mensagem = $_POST['mensagem'];

    // Validação e Inserção no Banco de Dados
    $sql = "INSERT INTO contatos (nome, email, assunto, mensagem) VALUES ('$nome', '$email', '$assunto', '$mensagem')";

    if ($conexao->query($sql) === TRUE) {
        $status = 'sucesso';
    } else {
        $status = 'erro';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="estilo.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="shortcut icon" type="imagex/png" href="icone.ico">
  <title>FAQ</title>
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
  </nav>

<div class="container mt-5">
    <div class="container mt-5">
        <h1 class="text-center">Contato</h1>

        <?php if ($status === 'sucesso'): ?>
            <div class="alert alert-success text-center" role="alert">
                Mensagem enviada com sucesso!
            </div>
        <?php elseif ($status === 'erro'): ?>
            <div class="alert alert-danger text-center" role="alert">
                Erro ao enviar mensagem. Tente novamente.
            </div>
        <?php endif; ?>

    <form action="" method="POST" class="mt-4">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="assunto" class="form-label">Assunto</label>
            <input type="text" name="assunto" id="assunto" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="mensagem" class="form-label">Mensagem</label>
            <textarea name="mensagem" id="mensagem" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>

  <script src="app.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>