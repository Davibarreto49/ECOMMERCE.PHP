<?php
include("conectadb.php");
session_start();
if(isset($_SESSION['nomeusuario'])){
    $nomeusuario = $_SESSION['nomeusuario'];
    $idusuario = $_SESSION['idusuario'];
}else{
    $nomeusuario = "";
}

?>
<div>
    <ul class="menu">
        <li><a href="loja.php">HOME</a></li>
        <!-- valida se sessão de usuario está autencada, senão, pede o login-->
        <?php
        if($nomeusuario != ""){
        ?>
        <li class="profile"><a href="logoutclinte.php">SAIR</a></li>
        <li class="profile"><a href="perfil.php?id=<?= ($idusuario) ?>">OLÁ <?= strtoupper($nomeusuario)?></a></li>
        <li class="profile"><a class="menuloja" href="carrinho.php?id=">CARRINHO <?=($nomeusuario)?></a></li>

        <?php
        }else{
        ?>
        <li class="profile"><a class="profile" href="login-cliente.php">LOGIN</a></li>
        <?php
        }
        ?>
    </ul>
</div>
</body>
</html>