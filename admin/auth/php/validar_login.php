<?php
include('../../../connection/connection.php');
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$_SESSION['cpf'] = $_POST['cpf'];
$cpf = $_POST['cpf'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM `vendedor` WHERE `cpf` = '$cpf' AND `senha` = '$senha'";
$resultado = mysqli_query($conn, $sql) or die("Erro ao retornar dados");
$row = mysqli_fetch_array($resultado);

$_SESSION['nome'] = $row['nome'];

if ($resultado->num_rows == 1) {
    header("Location: ../../../index.php");
} else {
    echo "Usuário ou senha inválidos.";
}

?>