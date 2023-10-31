<?php
session_start();// inicia a sessão

session_destroy();//destroi a sessão atual

header("Location: login.php");//redireciona o usuario para a página de login
exit;
?>