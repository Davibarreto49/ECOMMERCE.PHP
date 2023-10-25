<?php
//*INICIA A CONEXÃO COM O BANCO DE DADOS
include("conectadb.php");
//*COLETA DE VARIÁVEIS VIA FORMULÁRIO DE HTML
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $nome = trim($nome);
    $descricao = $_POST['descricao'];
    $descricao = trim($descricao);
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];
    $imagem = $_POST['imagem'];
    //*PASSANDO INSTRUÇÕES SQL PARA O BANCO

    if(isset($_FILES['imagem']) && $_FILES['imagem']
    ['error'] === UPLOAD_ERR_OK){
        $tipo = exif_imagetype($_FILES['imagem']['tmp_name']);
        if($tipo !== false) {
            $imagem_temp = $_FILES['imagem']['tmp_name'];
            $imagem = file_get_contents($imagem_temp);
            $image_base64 = base64_encode($imagem);
            ;
        } else {
                $imagem = file_get_contents
                ("C:\\xamp\\htdocs\\Ecommerce\\img\\alert.jpg");
                $image_base64 = base64_encode($imagem);
            }
    } else {
        $imagem = file_get_contents
                ("C:\\xamp\\htdocs\\Ecommerce\\img\\alert.jpg");
                $image_base64 = base64_encode($imagem);
    }

    //*VALIDANDO SE USUARIO EXISSTE
    $sql = "SELECT COUNT(pro_id) FROM produto WHERE pro_nome = '$nome'AND pro_ativo = 's'";
    $retorno = mysqli_query($link, $sql);
    while($tbl = mysqli_fetch_array($retorno)){
        $cont = $tbl[0];
    }
    //*VERIFICAÇÃO SE USUARIO EXISTE, SE EXISTE = 1 SENÃO = 0
    if($cont == 1) {
        echo "<script>window.alert('PRODUTO JÁ CADASTRADO!');</script>";
    }
    else{
        $sql = "INSERT INTO produto (pro_nome, pro_descricao, pro_quantidade, pro_preco, imagem1, pro_ativo) VALUES('$nome','$descricao', '$quantidade', '$preco','n')";
        mysqli_query($link, $sql);
        echo "<script>window.alert('PRODUTO CADASTRADO!');</script>";
        echo "<script>window.location.href='cadastroproduto.php';</script>";
    }
}
?>
<html>
    <head>
        <link rel="stylesheet" href="./estiloadm.css">
        <title>CADASTRO DE PRODUTO</title>
    </head>
    <body>
        <div>
            <form action="cadastroproduto.php" method="post">
                <label>Nome do Produto</label>
                <input type="text" name="nome" id="nome" placeholder="Nome de Produto">
                <p></p>
                <label>Descrição</label>
                <input id="desc" type="text" name="descricao" id="descricao" placeholder="Descrição">
                <p></p>
                <label>Quantidade</label>
                <input type="number" name="quantidade" id="quantidade" placeholder="Quantidade">
                <p></p>
                <label>Preço</label>
                <input type="decimal" name="preco" id="preco" placeholder="Preço">
                <p></p>
                <label>Imagem</label>
                <input type="file" name="imagem" id="imagem" placeholder="Imagem">
                <p></p>
                <input type="submit" name="cadastrar" id="cadastrar" placeholder="Cadastrar">
            </form>
        </div>
    </body>
</html>
