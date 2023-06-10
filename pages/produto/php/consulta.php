<?php 
    include('../../../connection/connection.php');
    if (session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    // $produto = $_POST['inputP'];
    $categoria = $_POST['inputC'];    

    $msg_erro = "Nenhum registro encontrado.";

    if (empty($categoria)){
        $sql = "SELECT * FROM list_prod_cat ORDER BY cod";   
    }elseif (!empty($categoria)){
        // $sql = "SELECT * FROM list_prod_cat WHERE nome LIKE '%$produto%' AND id_categoria LIKE '%$categoria%' ORDER BY cod";
        $sql = "SELECT * FROM list_prod_cat WHERE id_categoria LIKE '%$categoria%' ORDER BY cod";        
        echo $msg_erro;
    }
    $resultado = mysqli_query($conn,$sql) or die("Erro ao retornar dados");
    
    while ($registro = mysqli_fetch_array($resultado)){
        $cod = $registro ['cod'];
        $nome = $registro ['nome'];
        $preco = $registro ['preco'];
        $qtd_estoque = $registro ['qtd_estoque'];
        $qtd_estoque_min = $registro ['qtd_estoque_min'];
        $unidade_medida = $registro ['unidade_medida'];
        $id_categoria = $registro ['id_categoria'];
        $categoria = $registro ['categoria'];
?>

<tr>
    <td><?=$cod ?></td>
    <td><?=$nome ?></td>
    <td><?=$preco ?></td>
    <td><?=$qtd_estoque ?></td>
    <td><?=$qtd_estoque_min ?></td>
    <td><?=$unidade_medida ?></td>
    <td><?=$categoria ?></td>   
</tr>

<?php
}
mysqli_close($conn);
?>



