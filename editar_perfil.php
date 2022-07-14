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
    <title>Editar Perfil</title>
</head>

<body>
    

    <?php
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $dad['nome'] = $_SESSION['nome'];
    $dad['usuario'] = $_SESSION['usuario'];
    $dad['senha_usuario'] = $_SESSION['senha_usuario'];
    $dad['cidade'] = $_SESSION['cidade'];
    $idvar = $_SESSION['id'];
    $texto ="";
    //verificando se usuário (email) já existe no bd
    if (!empty($dados['SendCad'])) {
    $empty_input = false;
    $query_usuario = "SELECT usuario
                        FROM usuarios 
                        WHERE contass =:contass
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
    
   
     
         if (!$empty_input && ($result_usuario->rowCount() <= 0) && (filter_var($dados['usuario'], FILTER_VALIDATE_EMAIL)) && strlen($dados['senha_usuario']) >= 6){
        $query_cad = "UPDATE usuarios
SET nome=:nome, usuario=:usuario, cidade=:cidade, senha_usuario=:senha_usuario WHERE id=$idvar";
        $result_cad = $conn->prepare($query_cad);
        $result_cad->bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR);
       $result_cad->bindParam(':nome', $dados['nome'], PDO::PARAM_STR); $result_cad->bindParam(':senha_usuario', $dados['senha_usuario'],
 PDO::PARAM_STR);
 $result_cad->bindParam(':cidade', $dados['cidade'],
 PDO::PARAM_STR);
        $result_cad->execute();

    

        if(($result_cad) AND ($result_cad->rowCount() != 0)){
            $row_cad = $result_cad->fetch(PDO::FETCH_ASSOC);
         
            }
            
            
//exibindo msg de sucesso ou erro caso o cadastro exista problema na conexão com o bd
                
                if ($result_cad->rowCount()) {
                $_SESSION['nome'] = $dados['nome'];
                $_SESSION['usuario'] = $dados['usuario'];
                $_SESSION['senha_usuario'] = $dados['senha_usuario'];
                $_SESSION['cidade'] = $dados['cidade'];
                $dad['nome'] = $_SESSION['nome'];
    $dad['usuario'] = $_SESSION['usuario'];
    $dad['senha_usuario'] = $_SESSION['senha_usuario'];
    $dad['cidade'] = $_SESSION['cidade'];
                    $texto = "<input type='checkbox' id='toggle-1'>
<div id='mostra'>
<div class='block2'>
<div class='pop'>
<label for='toggle-1'>
  <div class='botao4'>&times;</div>
</label>
<div class='vb2'>
Dados Atualizados Com Sucesso!</div>
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
   <h1>Editar Perfil</h1>
    <label class="text">Nome:</label><br>
        <input class="campo" type="text" name="nome" placeholder="Nome" value="<?php if(isset($dad['nome'])){ echo $dad['nome']; } ?>"><br>
        
 <label class="text" for="cidade">Cidade:</label><br>
<select class="opc" name="cidade" id="cidades">
    <option value="<?php if(isset($dad['cidade'])){
    if($_SESSION['cidade']=='crateus'){
     echo crateus;}
     else{
     echo fortaleza;} } ?>"><?php if(isset($dad['cidade'])){
    if($_SESSION['cidade']=='crateus'){
     echo Crateús;}
     else{
     echo Fortaleza;} } ?></option>
    <option value="<?php if(isset($dad['cidade'])){
    if($_SESSION['cidade']=='crateus'){
     echo fortaleza;}
     else{
     echo crateus;} } ?>"><?php if(isset($dad['cidade'])){
    if($_SESSION['cidade']=='crateus'){
     echo Fortaleza;}
     else{
     echo Crateús;} } ?></option>
</select><br>
        <label class="text">Email:</label><br>
        <input class ="campo" type="text" name="usuario" placeholder="Digite o usuário" value="<?php if(isset($dad['usuario'])){ echo $dad['usuario']; } ?>"><br>

        <label class="text">Senha:</label><br>
        <input class="campo" type="text" name="senha_usuario" placeholder="Digite a senha" value="<?php if(isset($dad['senha_usuario'])){ echo $dad['senha_usuario']; } ?>"><br>

        <input class="botao" type="submit" value="Atualizar Dados" name="SendCad">
    </form></div>
<br>
    <br><br>
</body>

</html>
