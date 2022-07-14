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
    <title>Página de Cadastro de Locais</title>
</head>

<body>
    

    <?php
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $texto ="";
    
    if (!empty($dados['SendCad'])) {
    $empty_input = false;
    $query_usuario = "SELECT nome
                        FROM locais
                        WHERE nome =:nome
                        LIMIT 1";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
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
 
    if($result_usuario->rowCount() >= 0 && $empty_input==false){
 $texto = "<input type='checkbox' id='toggle-1'>
<div id='mostra'>
<div class='block2'>
<div class='pop'>
<label for='toggle-1'>
  <div class='botao2'>&times;</div>
</label>
<div class='vb'>
Erro: Local Já Existe!</div>
<div class='er'>:(</div>
   </div></div>
</div>";}

   
      
         if (!$empty_input && ($result_usuario->rowCount() <= 0)){
        $query_cad = "INSERT INTO locais (nome, cnpj, bairro, rua, cep) VALUES (:nome, :cnpj, :bairro, :rua, :cep) ";
        $result_cad = $conn->prepare($query_cad);
        $result_cad->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
       $result_cad->bindParam(':cnpj', $dados['cnpj'], PDO::PARAM_STR); $result_cad->bindParam(':bairro', $dados['bairro'],
 PDO::PARAM_STR);
 $result_cad->bindParam(':rua', $dados['rua'],
 PDO::PARAM_STR);
 $result_cad->bindParam(':cep', $dados['cep'],
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
Cadastro Feito Com Sucesso! <div class='poptext'>Aguarde Até que as informações do local sejam verificadas e cadastradas no mapa</div></div>
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
   <h1>Cadastre o seu Local de Coleta</h1>
    <label class="text">Nome do Projeto:</label><br>
        <input class="campo" type="text" name="nome" placeholder="Nome do Projeto" value="<?php if(isset($dados['nome'])){ echo $dados['nome']; } ?>"><br>
       
        <label class="text">CNPJ:</label><br>
        <input class ="campo" type="text" name="cnpj" placeholder="Digite o CNPJ" value="<?php if(isset($dados['cnpj'])){ echo $dados['cnpj']; } ?>"><br>

        <label class="text">Bairro:</label><br>
        <input class="campo" type="text" name="bairro" placeholder="Digite o seu Bairro" value="<?php if(isset($dados['bairro'])){ echo $dados['bairro']; } ?>"><br>

      <label class="text">Rua e Número:</label><br>
        <input class="campo" type="text" name="rua" placeholder="Digite a Rua e o Número" value="<?php if(isset($dados['rua'])){ echo $dados['rua']; } ?>"><br>
        
       <label class="text">CEP:</label><br>
        <input class="campo" type="text" name="cep" placeholder="Digite o seu CEP" value="<?php if(isset($dados['cep'])){ echo $dados['cep']; } ?>"><br>

        <input class="botao" type="submit" value="Cadastrar Local" name="SendCad">
    </form></div>
<br>
    <br><br>
</body>

</html>
