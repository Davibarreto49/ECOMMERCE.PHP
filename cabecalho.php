<?php
include("conectadb.php");
session_start();
isset($_SESSION['nomeusuario'])?$nomeusuario = $_SESSION['nomeusuario']: "";
$nomeusuario = $_SESSION['nomeusuario'];

?>
<div>
    <ul class="menu">
        <li><a href="cadastrausuario.php">CADASTRAR USUARIO</a></li>
        <li><a href="listausuario.php">LISTAR USUARIO</a></li>
        <li><a href="cadastroproduto.php">CADASTRAR PRODUTO</a></li>
        <li><a href="listproduto.php">LISTAR PRODUTO</a></li>
        <li class="menuloja"><a href="logout.php">SAIR</a></li>

        <?php
        if($nomeusuario != null){
        ?>
          <li class="profile">OLÁ <?= strtoupper($nomeusuario) ?></li>
        <?php
        } else {
            echo"<script>window.alert('USUARIO NÃO IDENTIFICADO');window.location.href='login.php';</script>";
        }  
        ?>    
    </ul>
</div>