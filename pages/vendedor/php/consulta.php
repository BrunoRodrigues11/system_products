<?php 
    include('../../../connection/connection.php');
    if (session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    $pesq_1 = $_POST['input'];
    $msg_erro = "Nenhum registro encontrado.";

    if (empty($pesq_1)){
        $sql = "SELECT * FROM vendedor ORDER BY cod";   
    }elseif (!empty($pesq_1)){
        $sql = "SELECT * FROM vendedor WHERE nome LIKE '%$pesq_1%' ORDER BY nome";
        echo $msg_erro;
    }
    $resultado = mysqli_query($conn,$sql) or die("Erro ao retornar dados");
    
    while ($registro = mysqli_fetch_array($resultado)){
        $cod = $registro ['cod'];
        $nome = $registro ['nome'];
        $telefone = $registro ['telefone'];        
        $endereco = $registro ['endereco'];
        $cidade = $registro ['cidade'];
        $estado = $registro ['estado'];
        $porc_comissao = $registro ['parc_comissao'];
    
?>

<tr>
    <td><?=$cod ?></td>
    <td><?=$nome ?></td>
    <td><?=$telefone ?></td>    
    <td><?=$endereco ?></td>
    <td><?=$cidade ?></td>
    <td><?=$estado ?></td>
    <td><?=$porc_comissao ?></td>
</tr>

<?php
}
mysqli_close($conn);
?>



