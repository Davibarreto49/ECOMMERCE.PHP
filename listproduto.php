<?php
#abre uma conexão com o banco de dados
include("conectadb.php");

#passando uma instrução ao banco de dados
$sql = "SELECT * FROM usuarios WHERE usu_ativo = 's'";
$retorno = mysqli_query($link, $sql);

#força sempre trazer 'S' na variável para utlizarmos nos radios button
$ativo = "s";

#coleta o botão método post vindo do html
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $ativo = $_POST['ativo'];

    #verifica se o usuario está ativo para listar,
    # se 'S' lista senão, não lista
    if($ativo == 's'){
        $sql = "SELECT  * FROM usuarios WHERE usu_ativo = 's'";
        $retorno = mysqli_query($link, $sql);
    } else{
        $sql = "SELECT  * FROM usuarios WHERE usu_ativo = 'n'";
        $retorno = mysqli_query($link, $sql);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./estiloadm.css">
    <title>LISTA PRODUTO</title>
</head>
<body>
    <div id="background">
    <form action="listproduto.php" method="post">
        <input type="radio" name="ativo" class="radio" value="s"
        required onclick="submit()" <?= $ativo == 's' ? "checked" : "" ?>>ATIVOS
        <br>
        <input type="radio" name="ativo" class="radio" value="n"
        required onclick="submit()" <?= $ativo == 'n' ? "checked" : "" ?>>INATIVOS
    </form>
    <div class="container">
        <table border="1">
            <tr>
                <th>NOME</th>
                <th>DESCRIÇÃO</th>
                <th>QUANTIDADE</th>
                <th>PREÇO</th>
                <th>ATIVO</th>
            </tr>
            <!-- INICIO DE PHP + HTML -->
            <?php
            #fazendo preenchimento de tabela usando while
            #(enquanto tem dados roda preenchimento)
            while ($tbl = mysqli_fetch_array($retorno)){

            
            ?>
                <tr>
                    <td><?= $tbl[1] ?></td><!-- traz somente a coluna 1 [nome] do banco -->
                    <!-- ao clicar no botão ele já trará o id do usuario para a página do -->
                    <td><a href="alterausuario.php?id=<? $tbl[0] ?>"><input type="button"
                    value="ALTERAR DADOS"></a></td>

                    <td><?= $check = ($tbl[3] == "s") ? "SIM" : "NÃO"?></td>

                </tr>
            <?php
            }
            ?>    
        </table>
    </div>
    </div>
</body>
</html>