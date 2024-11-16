<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="shortcut icon" type="imagex/png" href="icone.ico">
    <title>Login</title>
    <style>
        body
        {
            background-color: rgb(187, 135, 68);
        }
        .tela_login
        {
            background-color: grey;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            padding: 60px;
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
        .inputSubmit
        {
            background-color: black;
            border: none;
            color: white;
            padding: 15px;
            width: 100%;
            border-radius: 15px;
            font-size: 17px;
        }
        .inputSubmit:hover
        {
            background-color: lightgray;
        }
        .cad
        {
            color: white;
        }
        .cad:hover
        {
            color: #cb9d62;
        }
        .loginTexto
        {
            text-align: center;
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
          <a href="cadastro.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Cadastrar</a>
        </div>
    </nav>

    <div class="tela_login">
        <h1 class="loginTexto">Login</h1>
        <br>
        <form action="testeLogin.php" method="POST">
            <input type="text" name="emailUsuario" placeholder="E-mail ou Usuário">
            <br>
            <br>
            <input type="password" name="senha" placeholder="Senha">
            <br>
            <br>
            <input class="inputSubmit" type="submit" name="submit" value="Entrar">
            <br>
            <br>
            <p>
                Não poussui uma conta?
                <a class="cad" href="cadastro.php">Cadastre-se!</a>
            </p>
        </form>
    </div>
</body>
</html>