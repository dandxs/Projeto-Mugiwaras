<?php
session_start();
ob_start();
include_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
     <meta name="theme-color" content="#A7C957" />
     <link rel="stylesheet" href="styles2.css" type="text/css"/>
     <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <title>Página de Login</title>
</head>

<body>

    <?php
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//verificando se o campo n está vazio e a realizando a consulta com sql no bd pelo usuário e a senha
    if (!empty($dados['SendLogin'])) {
        $query_usuario = "SELECT id, nome, usuario, senha_usuario, tipo_conta, cidade
                        FROM usuarios 
                        WHERE usuario = :usuario AND senha_usuario = :senha_usuario 
                        LIMIT 1";
        $result_usuario = $conn->prepare($query_usuario);
        $result_usuario->bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR);
        $result_usuario->bindParam(':senha_usuario', $dados['senha_usuario'], PDO::PARAM_STR);
        $result_usuario->execute();

        if(($result_usuario) AND ($result_usuario->rowCount() != 0)){
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            //realizando login ou exibindo msg de erro
            if ($result_usuario->rowCount()){
                $_SESSION['id'] = $row_usuario['id'];
                $_SESSION['nome'] = $row_usuario['nome'];
                $_SESSION['tipo_conta'] = $row_usuario['tipo_conta'];
                $_SESSION['usuario'] = $row_usuario['usuario'];
                $_SESSION['senha_usuario'] = $row_usuario['senha_usuario'];
                $_SESSION['cidade'] = $row_usuario['cidade'];
                header("Location: dashboard.php");
            }else{
                $_SESSION['msg'] = "<input type='checkbox' id='toggle-1'>
<div id='mostra'>
<div class='block2'>
<div class='pop'>
<label for='toggle-1'>
  <div class='botao2'>&times;</div>
</label>
<div class='vb'>
Erro: Usuário ou senha inválidos!</div>
<div class='er'>:(</div>
   </div></div>
</div>";
            }
        }else{
            $_SESSION['msg'] = "<input type='checkbox' id='toggle-1'>
<div id='mostra'>
<div class='block2'>
<div class='pop'>
<label for='toggle-1'>
  <div class='botao2'>&times;</div>
</label>
<div class='vb'>
Erro: Usuário ou senha inválidos!</div>
<div class='er'>:(</div>
   </div></div>
</div>";
        }

        
    }

    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>




<div class="form-center"> <form method="POST" action="">
<a class="arrow" href="dashboard.php">&larr;</a>
   <h1>Faça Login</h1>
 
        <label class="text">Email:</label><br>
        <input class ="campo" type="text" name="usuario" placeholder="Digite o usuário" value="<?php if(isset($dados['usuario'])){ echo $dados['usuario']; } ?>"><br>

        <label class="text">Senha:</label><br>
        <input class="campo" type="password" name="senha_usuario" placeholder="Digite a senha" value="<?php if(isset($dados['senha_usuario'])){ echo $dados['senha_usuario']; } ?>"><br>
<a class="link2" href="#">Esqueceu a Senha?</a><br>
        <input class="botao" type="submit" value="Login" name="SendLogin">
    </form></div>



    <br>
    <a class="link3" href="cadastro.php">Não Tem Conta? Cadastre-se Já!</a>
</body>

</html>