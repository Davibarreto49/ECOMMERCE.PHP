 <?php
include("cabecalho2.php");

$idusuario = $_SESSION['isusuario'];

 #PESQUISA IDENTIFICADOR DO CARRINHO
 $sql = "SELECT c.car_id, c.fk_cli_id, c.car_finalizado,
 p.pro_id, p.pro_nome, p.pro_descricao, p.pro_preco, p.imagem1,
 ic.car_item_quantidade, ic.fk_car_id, ic.fk_pro_id
 FROM carrinho c
 JOIN item_carrinho ic ON c.car_id = ic.fk_car_id
 JOIN produtos p ON ic.fk_pro_id = p.pro_id
 WHERE c.fk_cli_id = $idusuario
 AND c.car_finalizado = 'n'";
 $retorno = mysqli_query($link, $sql);
 $retorno2 = mysqli_query($link, $sql);# usado para fazer o total

 $total = 0;// Inicializa a variavel total

 while($row = mysqli_fetch_assoc($retorno2)){
    $preco = $row['pro_preco'];
    $quantidade = $row['car_item_quantidade'];
    $subtotal = $preco * $quantidade;
    $total += $subtotal;
 }
?>

    <title>MEUS CARRINHO</title>
</head>
<!-- TOTAL E FINALIZA CARRINHO-->
<body>
    <div style="width: 100%; height: 10px; background-color: transparent;"></div>
    <div class="total" style="width: 100%; height: 30px">TOTAL R$ <?= $total ?></div>
    <div class="total" style="width: 100%; height: 30px">
    <a href="finaliza_carrinho.php?id=<?=  ($idusuario)?>">FINALIZA CARRINHO</a>
    </div>

    <!-- DIV ACIMA APENAS PARA SEPARAR O MENU -->
    <?php
    while($tbl = mysqli_fetch_array($retorno)){
    ?>
    <div class="product-card">
        <img src="data:image/jpeg;base64,<?= $tbl[7] ?>" alt="Product Image">
        <h3 class="product-title"> <?= $tbl[4] ?></h3>
        <h3 class="product-price">R$ <?= $tbl[6] * $tbl[8] ?></h3>
        <label>QUANTIDADE</label>
        <div><button onclick="location.href='atualizar_carrinho.php?var1=<?= $tbl[3] ?>&var2=<?= $tbl[8] -1?>'"
        class="plus-button">
        </button><h3 class="product-price plus-button"><?= $tbl[8] ?></h3>
        <button onclick="location.href='atualizar_carrinho.php?var1<?= $tbl[3]?>&var2<?= $tbl[8] +1?>'"
        class="plus-button">+</button></div>
        <br>
        <div><button onclick="location.href='deleta_produto_carrinho.php?var1=<?= $tbl[3]?>&var2=<?= $tbl[0]?>'" 
        class="plus-button">Excluir do Carrinho</button></div>
    </div>
    <?php
    }
    ?>
</body>
</html>