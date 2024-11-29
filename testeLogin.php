<?php
    session_start();
    //print_r($_REQUEST);

    if(isset($_POST['submit']) && !empty($_POST['emailUsuario']) && !empty($_POST['senha']))
    {
        //Acessa
        include_once('config.php');
        $emailUsuario = $_POST['emailUsuario'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM usuarios WHERE email = '$emailUsuario' or usuario = '$emailUsuario' LIMIT 1";

        $result = $conexao->query($sql);

        $usuarios = $result->fetch_assoc();

        if(mysqli_num_rows($result) < 1)
        {
            unset($_SESSION['emailUsuario']);
            unset($_SESSION['senha']);
            header('Location: login_usuario_senha_incorreto.php');
        }

        if (password_verify($senha, $usuarios['senha']))
        {
            $_SESSION['emailUsuario'] = $emailUsuario;
            $_SESSION['senha'] = $senha;
            header('Location: index.php');
        }
    }
?>