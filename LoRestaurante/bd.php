<?php
$conexao = NULL;
$conexao_readwrite = NULL;

//Cria a conexão com o banco
//$mysqli = mysqli_connect('localhost', 'id6185809_root', 'rootroot', 'id6185809_lo_restaurante');
$mysqli = mysqli_connect('localhost', 'root', 'root', 'lo_restaurante');

//Não precisa dos comando abaixo
//mysqli_query($mysqli, "SET NAMES 'utf8'");
//mysqli_query($mysqli,'SET character_set_connection=utf8');
//mysqli_query($mysqli,'SET character_set_client=utf8');
//mysqli_query($mysqli,'SET character_set_results=utf8');
//mysqli_query($mysqli,"SET time_zone = 'America/Sao_Paulo';");