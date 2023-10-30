<?php
include("conectadb.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $ativo = $_POST['ativo'];
    $senha = $_POST['senha'];

        #$sql = "SELECT usu_tempero FROM usuarios WHERE usu_nome = '$nome'";
        #$retorno = mysqli_query($link, $sql);
        #while($tbl = mysqli_fetch_array($retorno)){
            #$tempero = $tbl[0];
        #}

    #if($senha != $senha2)
    #{
     #   $senha = md5($senha . $tempero);
    #}

    $sql = "UPDATE usuarios SET usu_senha = '$senha', usu_nome = '$nome', usu_ativo = '$ativo' WHERE usu_id = '$id'";
    
    mysqli_query($link, $sql);

    echo"<script>window.alert('USUARIO ALTERADO COM SUCESSO');</script>";
    echo"<script>window.location.href='listausuario.php';</script>";

    #echo "<script>window.location.href='cadastroproduto.php';</script>";
    exit();
}


$id =  $_GET['id'];
$sql = "SELECT * FROM usuarios WHERE usu_id = '$id'";
$retorno = mysqli_query($link, $sql);

while($tbl = mysqli_fetch_array($retorno)){
    $nome = $tbl[1];
    $senha = $tbl[2];
    $ativo = $tbl[3];
    #tempero= $tbl[4];
    $senha2 = $senha;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./estiloadm.css">
    <title>ALTERA USUÁRIO</title>
</head>
<body>

    <div>
        <form action="alterausuario.php" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">
            <label>NOME</label>
            <input type="text" name="nome" value="<?= $nome ?>" required>
            <label>SENHA</label>
            <input type="password" name="senha" value="<?= $senha ?>" required>
            <p></p>
            <label>STATUS: <?= $check = ($ativo == 's') ? "ATIVO" : "INATIVO" ?></label>
            <p></p>
            <input type="radio" name="ativo" value="s"
            <?= $ativo == "s" ? "checked" : "" ?>>ATIVO<br>
            <input type="radio" name="ativo" value="n"
            <?= $ativo == "n" ? "checked" : "" ?>>INATIVO

            <input type="submit" value="SALVAR">
        </form>
    </div>
    
</body>
</html>