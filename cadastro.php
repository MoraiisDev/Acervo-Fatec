<?php

    if(isset($_POST['submit']) && !empty($_POST['usuario']) && !empty($_POST['email']) && !empty($_POST['senha']))
    {
        include_once('config.php');

        $usuario = $_POST['usuario'];
        $email = $_POST['email'];
        $dataNasc = $_POST['dataNasc'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        
        $sql = "SELECT * FROM usuarios WHERE email = '$email' or usuario = '$usuario'";

        $result = $conexao->query($sql);

        if(mysqli_num_rows($result) > 0)
        {
            $result = mysqli_query($conexao, "DELETE FROM usuarios WHERE email = '$email' and senha = '$senha' or usuario = '$usuario' and senha = '$senha'");
            header('Location: cadastro.php');
        }
        else
        {
            $result = mysqli_query($conexao, "INSERT INTO usuarios(usuario,email,dataNascimento,senha) VALUES ('$usuario','$email','$dataNasc','$senha')");
            header('Location: login.php');
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="shortcut icon" type="imagex/png" href="icone.ico">
    <title>Cadastro</title>
    <style>
        body
        {
            background-color: rgb(187, 135, 68);
        }
        .tela-cadastro
        {
            background-color: grey;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            padding: 80px;
            border-radius: 15px;
            color: white;
        }
        input
        {
            padding: 15px;
            border: none;
            outline: none;
            font-size: large;
            width: 100%;
        }
        #submit
        {
            background-color: black;
            border: none;
            color: white;
            padding: 15px;
            width: 100%;
            border-radius: 15px;
            font-size: 17px;
        }
        #submit:hover
        {
            background-color: lightgray;
        }
    </style>
</head>
<body>
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
          <a href="login.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Login</a>
        </div>
    </nav>

    <div class="tela-cadastro">
        <form action="cadastro.php" method="POST">
            <fieldset>
                <legend><b>Cadastro</b></legend>
                <br>
                <div class="inputbox">
                    <input type="text" name="usuario" id="usuario" class="inputUser" required>
                    <label for="usuario">Usuario</label>
                </div>
                <br>
                <div class="inputbox">
                    <input type="email" name="email" id="email" class="inputUser" required>
                    <label for="email">E-mail</label>
                </div>
                <br>
                <div class="inputbox">
                    <input type="date" name="dataNasc" id="dataNasc" class="inputUser" required>
                    <label for="datacasc">Data de Nascimento</label>
                </div>
                <br>
                <div class="inputbox">
                    <input type="password" name="senha" id="senha" class="inputUser" required>
                    <label for="senha">Senha</label>
                </div>
                <br>
                <input type="submit" name="submit" id="submit" value="Cadastrar">
            </fieldset>
        </form>
    </div>
</body>
</html>