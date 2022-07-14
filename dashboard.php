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
     <link rel="stylesheet" href="styles2.css" type="text/css"/>
     <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
     <script src="https://kit.fontawesome.com/0e5dd61345.js" crossorigin="anonymous"></script>
    <title>Dashboard</title>
</head>

<body>

<?php

$d = "<h1>Erro</h1>";
$a = $_SESSION['nome'];
if((!isset($_SESSION['id'])) AND (!isset($_SESSION['nome']))){
$d = "<h1>Bem Vindo!</h1><div class='espaco'><br></div>
<div class='block'><a class='item1' href='mapa.html'><i class='fa fa-map-marker' id='ic1' aria-hidden='true'></i>Mapa</a>
   <a class='item2' href='eventos.html'><i class='fa fa-calendar' id='ic1' aria-hidden='true'></i>Eventos</a></div>
   <div class='block'><a class='item2' href='cadastro.php'><i class='fa fa-user-plus' id='ic1' aria-hidden='true'></i>Cadastrar</a><a class='item1' href='login.php'><i class='fa fa-sign-in' id='ic1' aria-hidden='true'></i>Login</a></div>
<br>
";
    //header("Location: home.php");
}
else{
if($_SESSION['tipo_conta']=='fisica'){
$d = "<div class='blockn'><div id='per'>Bem Vindo $a!</div><a id='ic2' class='fa fa-user' aria-hidden='true' href='perfil.html'></a></div><div class='espaco'><br></div>
<div class='block'><a class='item1' href='mapa.html'><i class='fa fa-map-marker' id='ic1' aria-hidden='true'></i>Mapa</a>
   <a class='item2' href='novidades.html'><i class='fa fa-bullhorn' id='ic1' aria-hidden='true'></i>Novidades</a></div>
   <div class='block'><a class='item2' href='eventos.html'><i class='fa fa-calendar' id='ic1' aria-hidden='true'></i>Eventos</a><a class='item1' href='vamos_aprender.html'><i class='fa fa-recycle' id='ic1' aria-hidden='true'></i>Aprenda Sobre Coleta</a></div>
";}
else{
$d ="<div class='blockn'><div id='per'>Bem Vindo $a!</div><a id='ic2' class='fa fa-user' aria-hidden='true' href='perfil.html'></a></div><div class='espaco'><br></div>
<div class='block'><a class='item1' href='mapa.html'><i class='fa fa-map-marker' id='ic1' aria-hidden='true'></i>Mapa</a>
   <a class='item2' href='cadastro_local.php'><i class='fa fa-map-pin' id='ic1' aria-hidden='true'></i>Cadastrar Local</a></div>
   <div class='block'><a class='item2' href='cadastro_rota.php'><i class='fa fa-route' id='ic1' aria-hidden='true'></i>Cadastrar Rota</a><a class='item1' href='cadastro_evento.php'><i class='fa fa-calendar-plus' id='ic1' aria-hidden='true'></i>Cadastrar Evento</a></div>
";}
}
echo $d;
?>

    
    
</body>

</html>