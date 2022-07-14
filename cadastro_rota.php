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
    <title>Página de Cadastro de Rota</title>
</head>

<body>
    

    <?php
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $texto ="";
    //verificando se usuário (email) já existe no bd
    if (!empty($dados['SendCad'])) {
    $empty_input = false;
    $query_usuario = "SELECT nome
                        FROM rotas
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
    //exibindo msg caso o email já exista
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

   
      //realizando cadastro caso os campos n estejam vazios, o email seja válido, a senha tenha mais de 6 caracteres e o email ainda n exista no bd
         if (!$empty_input && ($result_usuario->rowCount() <= 0)){
        $query_cad = "INSERT INTO rotas (nome, cnpj, ponto1, ponto2, ponto3) VALUES (:nome, :cnpj, :ponto1, :ponto2, :ponto3) ";
        $result_cad = $conn->prepare($query_cad);
        $result_cad->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
       $result_cad->bindParam(':cnpj', $dados['cnpj'], PDO::PARAM_STR); $result_cad->bindParam(':ponto1', $dados['ponto1'],
 PDO::PARAM_STR);
 $result_cad->bindParam(':ponto2', $dados['ponto2'],
 PDO::PARAM_STR);
 $result_cad->bindParam(':ponto3', $dados['ponto3'],
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
Cadastro Feito Com Sucesso! <div class='poptext'>Aguarde Até que as informações da Rota sejam verificadas e cadastradas no mapa</div></div>
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
   <h1>Cadastre a sua Rota de Coleta</h1>
    <label class="text">Nome do Projeto:</label><br>
        <input class="campo" type="text" name="nome" placeholder="Nome do Projeto" value="<?php if(isset($dados['nome'])){ echo $dados['nome']; } ?>"><br>
       
        <label class="text">CNPJ:</label><br>
        <input class ="campo" type="text" name="cnpj" placeholder="Digite o CNPJ" value="<?php if(isset($dados['cnpj'])){ echo $dados['cnpj']; } ?>"><br>

        <label class="text">Rota:</label><br>
        <div class="tx1">Ponto 1:</div>
        <input class="campo" type="text" name="ponto1" placeholder="Digite o Endereço do Ponto 1" value="<?php if(isset($dados['ponto1'])){ echo $dados['ponto1']; } ?>"><br>
         <div class="tx1">Ponto 2:</div>
        <input class="campo" type="text" name="ponto2" placeholder="Digite o Endereço do Ponto 2" value="<?php if(isset($dados['ponto2'])){ echo $dados['ponto2']; } ?>"><br>
            <div class="tx1">Ponto 3:</div>
        <input class="campo" type="text" name="ponto3" placeholder="Digite o Endereço do Ponto 3" value="<?php if(isset($dados['ponto3'])){ echo $dados['ponto3']; } ?>"><br>



        <input class="botao" type="submit" value="Cadastrar Rota" name="SendCad">
    </form></div>
<br>
    <br><br>
</body>

</html>