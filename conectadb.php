<?php
#CONECTA COM O SERVIDOR (XAMPP)
$servidor = "localhost";
#nome do banco
$banco = "ecommerce";
#nome do usuário
$usuario = "admin";
#senha do usuario
$senha = "123";
#link de conexão com o banco
$link = mysqli_connect($servidor, $usuario, $senha, $banco);
echo('deu bom cara');
?>