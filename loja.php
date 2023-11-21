<?php
    #ABRE UMA CONEXÃO COM O BANCO DE DADOS
    include("conectadb.php");
 
    #PASSANDO UMA INSTRUÇÃO AO BANCO DE DADOS
    $sql = "SELECT * FROM produtos WHERE pro_ativo = 's'";
    $retorno = mysqli_query($link, $sql);
 
    #COLETA O BOTÃO MÉTODO POST VINDO DO HTML
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sql = "SELECT * FROM produtos WHERE pro_ativo = 's'";
            $retorno = mysqli_query($link, $sql);
    }
?>
 
 
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="estiloadm.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <title>LOJA</title>
    </head>
   
    <main>
        <section id="creditos-container">
            <?php
 
            while ($tbl = mysqli_fetch_array($retorno)) {
 
            ?>
            <div class="profile">
                <img src="data:image/jpeg;base64,<?=$tbl[5] ?>" alt="Product Image">
                <hr>
                <h3 class="product-title"><?=$tbl[1] ?></h3>
               
                <?php
                if ($tbl[3] > 0) {
                ?>
                    <h3 class="product-price">R$ <?=$tbl[4] ?></h3>
                    <button class="product-button" onclick="location.href='verproduto.php?id=<?= $tbl[0] ?>'" >Comprar</button>
                <?php
                } else { //FORA DE ESTOQUE
                ?>
                <span class="product-stock">Fora de Estoque</span>
                <?php
                }
                ?>
            </div>
            <?php
            }
            ?>
        </section>
    </main>
</html>