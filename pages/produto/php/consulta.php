<?php 
    include('../../../connection/connection.php');
    if (session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    $pesq_1 = $_POST['input'];
    $msg_erro = "Nenhum registro encontrado.";

    if (empty($pesq_1)){
        $sql = "SELECT * FROM cliente ORDER BY codigo";   
    }elseif (!empty($pesq_1)){
        $sql = "SELECT * FROM cliente WHERE nome LIKE '%$pesq_1%' ORDER BY nome";
        echo $msg_erro;
    }
    $resultado = mysqli_query($conn,$sql) or die("Erro ao retornar dados");
    
    while ($registro = mysqli_fetch_array($resultado)){
        $cod = $registro ['codigo'];
        $nome = $registro ['nome'];
        $endereco = $registro ['endereco'];
        $telefone = $registro ['telefone'];
        $limite_cred = $registro ['limite_cred'];
        $cidade = $registro ['cidade'];
        $email = $registro ['email'];
        $cpf = $registro ['cpf'];
        $estado = $registro ['estado'];
?>

<tr>
    <td><?=$cod ?></td>
    <td><?=$nome ?></td>
    <td><?=$endereco ?></td>
    <td><?=$telefone ?></td>
    <td><?=$limite_cred ?></td>
    <td><?=$cidade ?></td>
    <td><?=$email ?></td>
    <td><?=$cpf ?></td>
    <td><?=$estado ?></td>
</tr>

<?php
}
mysqli_close($conn);
?>



