<?php
include("cabecalho.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $nome = trim($nome);
    $descricao = $_POST['descricao'];
    $descricao = trim($descricao);
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];
    $ativo = $_POST['ativo'];
    $imagem = $_POST['imagem'];


    $sql = "UPDATE produtos SET pro_nome = '$nome', pro_descricao = '$descricao',  pro_quantidade = '$quantidade',  pro_preco = '$preco', pro_ativo = '$ativo' WHERE pro_id = '$id'";
    
    mysqli_query($link, $sql);
    echo"<script>window.alert('PRODUTO ALTERADO COM SUCESSO');</script>";
    echo"<script>window.location.href='listproduto.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./estiloadm.css">
    <title>ALTERA PRODUTO</title>
</head>
<body>
        <div>
            <form action="alteraproduto.php" method="post">
                <label>Nome</label>
                <input type="text" name="nome" id="nome" placeholder="Nome">
                <p></p>
                <label>Descrição</label>
                <input id="desc" type="text" name="descricao" id="descricao" placeholder="Descrição">
                <p></p>
                <label>Quantidade</label>
                <input type="number" name="quantidade" id="quantidade" placeholder="Quantidade">
                <p></p>
                <label>Custo</label>
                <input type="decimal" name="custo" id="custo" placeholder="Custo">
                <p></p>
                <label>Imagem</label>
                <input type="file" name="imagem" id="imagem" placeholder="Imagem">
                <p></p>
                <input type="submit" name="cadastrar" id="cadastrar" placeholder="Cadastrar">
            </form>
        </div>
</body>
</html>