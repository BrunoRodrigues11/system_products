<?php 
    include('../../../connection/connection.php');
    if (session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    $numV = $_POST['numV']; 

    $sql = "SELECT * FROM list_itens_venda WHERE numero_venda = '$numV'";
    $resultado = mysqli_query($conn,$sql) or die(mysqli_connect_error());
    
    while ($registro = mysqli_fetch_array($resultado)){
        $item = $registro ['num_item'];
        $cod = $registro["cod"];
        $nome = $registro["nome"];        
        $um = $registro ['unidade_medida'];
        $preco = $registro ['preco'];
        $qtde = $registro ['quant_vendida'];
        $total = $registro ['total'];
        $numerV = $registro ['numero_venda'];        
?>

<tr>  
    <td><?=$item ?></td>
    <td><?=$cod ?></td>
    <td><?=$nome ?></td>    
    <td><?=$um ?></td>
    <td><?=$preco ?></td>
    <td><?=$qtde ?></td>
    <td><?=$total ?></td> 
    <td><?=$numerV ?></td>     
</tr>
<?php
    }
    mysqli_close($conn);
?>



