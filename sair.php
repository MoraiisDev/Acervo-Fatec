<?php
    session_start();
    unset($_SESSION['emailUsuario']);
    unset($_SESSION['senha']);
    header('Location: login.php');
?>