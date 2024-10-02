<?php
$host = "localhost";
$user = "root";
$pass = "";
$banco = "tcc";

$conexao = mysqli_connect($host, $user, $pass, $banco);
if($conexao === false){
  die("ERROR: Não foi possível se conectar ao banco de dados MySQL. " . mysqli_connect_error());
} 

else {
  mysqli_autocommit($conexao, FALSE);
}
?>