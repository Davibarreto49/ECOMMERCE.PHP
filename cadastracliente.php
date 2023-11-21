<?php
//*INICIA A CONEXÃO COM O BANCO DE DADOS
include("cabecalho2.php");
//*COLETA DE VARIÁVEIS VIA FORMULÁRIO DE HTML
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    //*PASSANDO INSTRUÇÕES SQL PARA O BANCO

    if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d])/', $senha)) {
        #(?=.*[a-z]): Pelo menos 1 letra minúscula.
        #(?=.*[A-Z]): Pelo menos 1 letra maiúscula.
        #(?=.*\d): Pelo menos 1 numeral.
        #(?=.*[^a-zA-Z\d]): Pelo menos 1 caractere especial 

        #passando instruções sql para o banco
        //*VALIDANDO SE USUARIO EXISSTE
        $sql = "SELECT COUNT(usu_id) FROM usuarios WHERE usu_nome = '$nome' AND usu_senha = '$senha' AND usu_ativo = 's'";
        $retorno = mysqli_query($link, $sql);
        while($tbl = mysqli_fetch_array($retorno)){
        $cont = $tbl[0];
        }
        //*VERIFICAÇÃO SE USUARIO EXISTE, SE EXISTE = 1 SENÃO = 0
        if($cont > 0) {
        echo "<script>window.alert('USUÁRIO JÁ CADASTRADO!');</script>";
        }
        else{

         $tempero = md5(rand() . date('H:i:s'));
         $senha = md5($senha . $tempero);

        $sql = "INSERT INTO usuarios (usu_nome, usu_senha, usu_ativo, usu_tempero) VALUES('$nome','$senha','n', '$tempero')";

        echo($sql);
        mysqli_query($link, $sql);
        echo "<script>window.alert('USUÁRIO CADASTRADO!');</script>";
        echo "<script>window.location.href='cadastrausuario.php';</script>";
       }
                }else {
                    echo "<script>window.alert('Senha Invalida');</script>";
                }
}
?>
<html>
    <head>
        <link rel="stylesheet" href="estiloadm.css">
        <title>CADASTRO DE CLIENTE</title>
    </head>
    <body>
        <div>
            <form action="cadastracliente.php" method="post">
                <input type="text" name="nome" id="nome" placeholder="Nome de cliente">
                <p></p>
                <input type="password" name="senha" id="senha" placeholder="Senha">
                <span id="MostrarSenha" onclick="MostrarSenha()">👁</span>
                <p></p>
                <input type="submit" name="cadastrar" id="cadastrar" placeholder="Cadastrar">
            </form>
        </div>
    </body>
</html>

<script>
    function MostrarSenha(){
        var passwordInput = document.getElementById("senha");
        var passwordIcon = document.getElementById("Mostrarsenha");

        if(passwordInput.type == "password"){
            passwordInput.type = "text"
            passwordIcon.textContent = "💡"
        } else{
            passwordInput.type = "password"
            passwordIcon.textContent = "👁"
        }
    }
</script>