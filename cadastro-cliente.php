<?php
//*INICIA A CONEXÃO COM O BANCO DE DADOS
include("cabecalho2.php");
//*COLETA DE VARIÁVEIS VIA FORMULÁRIO DE HTML
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $datanascimento = $_POST['datanascimento'];
    $telefone = $_POST['telefone'];
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $cidade = $_POST['cidade'];
    $email = $_POST['email'];
    //*PASSANDO INSTRUÇÕES SQL PARA O BANCO

    if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d])/', $senha)) {
        #(?=.*[a-z]): Pelo menos 1 letra minúscula.
        #(?=.*[A-Z]): Pelo menos 1 letra maiúscula.
        #(?=.*\d): Pelo menos 1 numeral.
        #(?=.*[^a-zA-Z\d]): Pelo menos 1 caractere especial 

        #passando instruções sql para o banco
        //*VALIDANDO SE USUARIO EXISSTE
        $sql = "SELECT COUNT(cli_id) FROM cliente WHERE cli_nome = '$nome' AND cli_senha = '$senha' AND cli_ativo = 's'";
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

        $sql = "INSERT INTO cliente (cli_nome, cli_senha, cli_datanasc, cli_cpf, cli_telefone, cli_logradouro, cli_numero, cli_cidade, cli_ativo, cli_tempero, cli_email) VALUES('$nome','$senha','n', '$tempero')";

        echo($sql);
        mysqli_query($link, $sql);
        echo "<script>window.alert('USUÁRIO CADASTRADO!');</script>";
        echo "<script>window.location.href='cadastrausuario.php';</script>";
       }
                }else {
                    echo "<script>window.alert('Senha Invalida');</script>";
                    echo "<script>window.alert('Coloque letras maiúsculas e minúsculas, números e caracteres diferentes!');</script>";
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
            <form action="cadastro-cliente.php" method="post">
                <input type="text" name="nome" id="nome" placeholder="Nome de Cliente">
                <p></p>
                <input type="password" name="senha" id="senha" placeholder="Senha">
                <span id="MostrarSenha" onclick="MostrarSenha()">👁</span>
                <p></p>
                <label>Data de Nascimento</label>
                <input type="date" id="datanascimento" name="datanascimento" required>
                <br>
                <label>CPF</label>
                <input type="number" id="cpf" name="cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" placeholder="Digite seu CPF (xxx.xxx.xxx-xx)" required>
                <br>
                <label>Telefone</label>
                <input type="number" id="telefone" name="telefone"  pattern="[0-10]{11}" placeholder="(16)12345-6789">
                <br>
                <label >Logradouro</label>
                <input type="text" id="logradouro" name="logradouro" placeholder="Rua Americo Brasilience">
                <br>
                <label>Número</label>
                <input type="text" id="numero" name="numero" placeholder="123">
                <br>
                <label>Cidade</label>
                <input type="text" id="cidade" name="cidade" placeholder="Ribeirão Preto">
                <br>
                <label for="email">E-mail</label>
                <input type="text" id="email"  name="email" required placeholder="nome@gmail.com">
                <br>
                <input type="submit" name="login" value="LOGIN">
                </form>
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