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
    <title>Página de Cadastro</title>
</head>

<body>
    

    <?php
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $texto ="";
    //verificando se usuário (email) já existe no bd
    if (!empty($dados['SendCad'])) {
    $empty_input = false;
    $query_usuario = "SELECT usuario
                        FROM usuarios 
                        WHERE usuario =:usuario  
                        LIMIT 1";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR);
    $result_usuario->execute();
    //verificando se os campos estão vazios
     if (in_array("", $dados)) {
                $empty_input = true;
                 $texto = "<input type='checkbox' id='toggle-1'>
<div id='mostra'>
<div class='block2'>
<div class='pop'>
<label for='toggle-1'>
  <div class='botao2'>&times;</div>
</label>
<div class='vb'>
Erro: Necessário Preencher Todos os Campos!</div>
<div class='er'>:(</div>
   </div></div>
</div>";
            } 
    //exibindo msg caso o email já exista
    if($result_usuario->rowCount() >= 0 && (filter_var($dados['usuario'], FILTER_VALIDATE_EMAIL)) && strlen($dados['senha_usuario'])>=6){
 $texto = "<input type='checkbox' id='toggle-1'>
<div id='mostra'>
<div class='block2'>
<div class='pop'>
<label for='toggle-1'>
  <div class='botao2'>&times;</div>
</label>
<div class='vb'>
Erro: Usuário Já Existe!</div>
<div class='er'>:(</div>
   </div></div>
</div>";}
//verificando se o email é válido 
    if (!filter_var($dados['usuario'], FILTER_VALIDATE_EMAIL) && !$empty_input){
    $empty_input = true;
     $texto = "<input type='checkbox' id='toggle-1'>
<div id='mostra'>
<div class='block2'>
<div class='pop'>
<label for='toggle-1'>
  <div class='botao2'>&times;</div>
</label>
<div class='vb'>
Erro: Email Inválido!</div>
<div class='er'>:(</div>
   </div></div>
</div>";}
   //exibindo msg caso a senha seja menor q 6 caracteres
   if (strlen($dados['senha_usuario']) < 6 && !$empty_input){
     $texto = "<input type='checkbox' id='toggle-1'>
<div id='mostra'>
<div class='block2'>
<div class='pop'>
<label for='toggle-1'>
  <div class='botao2'>&times;</div>
</label>
<div class='vb'>
Erro: Senha Deve Ter Pelo Menos 6 Caracteres!</div>
<div class='er'>:(</div>
   </div></div>
</div>";}
    
   
      //realizando cadastro caso os campos n estejam vazios, o email seja válido, a senha tenha mais de 6 caracteres e o email ainda n exista no bd
         if (!$empty_input && ($result_usuario->rowCount() <= 0) && (filter_var($dados['usuario'], FILTER_VALIDATE_EMAIL)) && strlen($dados['senha_usuario']) >= 6){
        $query_cad = "INSERT INTO usuarios (nome, usuario, senha_usuario, tipo_conta, cidade) VALUES (:nome, :usuario, :senha_usuario, :contass, :city) ";
        $result_cad = $conn->prepare($query_cad);
        $result_cad->bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR);
       $result_cad->bindParam(':nome', $dados['nome'], PDO::PARAM_STR); $result_cad->bindParam(':senha_usuario', $dados['senha_usuario'],
 PDO::PARAM_STR);
 $result_cad->bindParam(':contass', $dados['contass'],
 PDO::PARAM_STR);
 $result_cad->bindParam(':city', $dados['city'],
 PDO::PARAM_STR);
        $result_cad->execute();

    

        if(($result_cad) AND ($result_cad->rowCount() != 0)){
            $row_cad = $result_cad->fetch(PDO::FETCH_ASSOC);
         
            }
            
            
//exibindo msg de sucesso ou erro caso o cadastro exista problema na conexão com o bd
                
                if ($result_cad->rowCount()) {
                    $texto = "<input type='checkbox' id='toggle-1'>
<div id='mostra'>
<div class='block2'>
<div class='pop'>
<label for='toggle-1'>
  <div class='botao4'>&times;</div>
</label>
<div class='vb2'>
Cadastro Feito Com Sucesso! <a class='link' href='login.php'>Fazer login</a></div>
<div class='er2'>&check;</div>
   </div></div>
</div>";
                    unset($dados);
                } else {
                     $texto = "<input type='checkbox' id='toggle-1'>
<div id='mostra'>
<div class='block2'>
<div class='pop'>
<label for='toggle-1'>
  <div class='botao2'>&times;</div>
</label>
<div class='vb'>
Erro: Verifique os Campos e Tente Novamente</div>
<div class='er'>:(</div>
   </div></div>
</div>";
                }
            }
            echo $texto;
            
    }
    ?>
   <div class="form-center"> 
   <form method="POST" action="">
   <a class="arrow" href="dashboard.php">&larr;</a>
   <h1>Faça Seu Cadastro</h1>
    <label class="text">Nome:</label><br>
        <input class="campo" type="text" name="nome" placeholder="Nome" value="<?php if(isset($dados['nome'])){ echo $dados['nome']; } ?>"><br>
        <label class="text" for="conta">Tipo de Conta:</label><br>
<select class="opc" name="contass" id="contas">
    <option value="" disabled selected hidden>Selecione:</option>
    <option value="fisica">Pessoa Física</option>
    <option value="juridica">Pessoa Jurídica</option>
</select><br>
 <label class="text" for="cidade">Cidade:</label><br>
<select class="opc" name="city" id="cidades">
    <option value="" disabled selected hidden>Selecione:</option>
    <option value="crateus">Crateús</option>
    <option value="fortaleza">Fortaleza</option>
</select><br>
        <label class="text">Email:</label><br>
        <input class ="campo" type="text" name="usuario" placeholder="Digite o usuário" value="<?php if(isset($dados['usuario'])){ echo $dados['usuario']; } ?>"><br>

        <label class="text">Senha:</label><br>
        <input class="campo" type="password" name="senha_usuario" placeholder="Digite a senha" value="<?php if(isset($dados['senha_usuario'])){ echo $dados['senha_usuario']; } ?>"><br>

        <input class="botao" type="submit" value="Cadastrar" name="SendCad">
    </form></div>
<br>
    <a class="link3" href="login.php">Já Tem Conta? Faça Login!</a>
    <br><br>
</body>

</html>