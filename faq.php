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
if (isset($_POST['submit'])) {
  include_once('config.php');

  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $assunto = $_POST['assunto'];
  $mensagem = $_POST['mensagem'];

  $sql = "SELECT * FROM contatos WHERE email = '$email' AND assunto = '$assunto'";
  $result = $conexao->query($sql);

  if (mysqli_num_rows($result) > 0) {
    // remove mensagens duplicadas com o mesmo e-mail e assunto
    $sql_delete = "DELETE FROM contatos WHERE email = '$email' AND assunto = '$assunto'";
    $conexao->query($sql_delete);
    header('Location: contato.php');
  } else {
    // insere a nova mensagem
    $sql_insert = "INSERT INTO contatos(nome, email, assunto, mensagem) 
                       VALUES ('$nome', '$email', '$assunto', '$mensagem')";
    if ($conexao->query($sql_insert)) {
      header('Location: contato.php');
    } else {
      echo "Erro ao enviar mensagem: " . $conexao->error;
    }
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
    <h1 class="text-center">Contato</h1>
    <form action="processar_contato.php" method="POST" class="mt-4">
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
  </div>

  <script src="app.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>