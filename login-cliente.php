<?php
session_start();

include("conectadb.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $nome = $_POST['nomeusuario'];
    $senha = $_POST['senha'];

    #busca o tempero
    $sql = "SELECT usu_tempero FROM usuarios WHERE usu_nome = '$nome'";
    $retorno = mysqli_query($link, $sql);
    while($tbl = mysqli_fetch_array($retorno)){
        $tempero = $tbl[0];
    }

    $senha = md5($senha, $tempero);

    $sql = "SELECT COUNT(usu_id) FROM usuarios WHERE  usu_nome = '$nome' AND usu_senha = '$senha'";
    $retorno = mysqli_query($link, $sql);
    while($tbl = mysqli_fetch_array($retorno)){
        $cont = $tbl[0];
    }

    if($cont == 1){
        $sql = "SELECT * FROM usuarios WHERE usu_nome = '$nome' AND usu_senha = '$senha' AND usu_ativo = 's'";
        $retorno = mysqli_query($link, $sql);
        while($tbl = mysqli_fetch_array($retorno)){
            $_SESSION['idusuario'] = $tbl[0];
            $_SESSION['nomeusuario'] = $tbl[1];
        }
        
        echo "<script>window.location.href='listausuario.php';</script>";
    } else{
        echo "<script>window.alert('USUARIO OU SENHA INCORRETOS');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estiloadm.css">
    <title>LOGIN DE CLIENTE</title>
</head>
<body>
    <form action="login.php" method="POST">
        <h1>LOGIN DE CLIENTE</h1>
        <input type="text" name="nomeusuario" id="nome" placeholder="Nome">
        <p></p>
        <input type="password" id="senha" name="senha" placeholder="Senha">
        <p></p>
        <input type="submit" name="login" value="LOGIN">
    </form>
    
</body>
</html>