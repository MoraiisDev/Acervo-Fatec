<?php
    session_start();
    //print_r($_REQUEST);

    if(isset($_POST['submit']) && !empty($_POST['emailUsuario']) && !empty($_POST['senha']))
    {
        //Acessa
        include_once('config.php');
        $emailUsuario = $_POST['emailUsuario'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM usuarios WHERE email = '$emailUsuario' and senha = '$senha' or usuario = '$emailUsuario' and senha = '$senha'";
        
        $result = $conexao->query($sql);

        if(mysqli_num_rows($result) < 1)
        {
            unset($_SESSION['emailUsuario']);
            unset($_SESSION['senha']);
            header('Location: login.php');
        }
        else
        {
            $_SESSION['emailUsuario'] = $emailUsuario;
            $_SESSION['senha'] = $senha;
            header('Location: index.php');
        }
    }
    else
    {
        //Não acessa e retorna para página de login
        header('Location: login.php');
    }
?>