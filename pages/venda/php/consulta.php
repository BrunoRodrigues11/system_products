<?php 
    include('../../../connection/connection.php');
    if (session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    $data1 = $_POST['input1'];
    $data2 = $_POST['input2'];    
    $msg_erro = "Nenhum registro encontrado.";

    if (empty($data1) or empty($data2)){
        $sql = "SELECT vd.*, v.nome AS Vendedor, c.nome AS Cliente
                    FROM vendas vd
                    INNER JOIN vendedor v ON v.cod = vd.cod_vendedor
                    INNER JOIN cliente c ON c.codigo = vd.cod_cliente    
                    ORDER BY vd.numero";   
    }elseif (!empty($data1) or !empty($data)){
        $sql = "SELECT vd.*, v.nome AS Vendedor, c.nome AS Cliente
                    FROM vendas vd
                    INNER JOIN vendedor v ON v.cod = vd.cod_vendedor
                    INNER JOIN cliente c ON c.codigo = vd.cod_cliente    
                    WHERE data BETWEEN '$data1' AND '$data2'
                    ORDER BY vd.numero";
        echo $msg_erro;
    }
    $resultado = mysqli_query($conn,$sql) or die("Erro ao retornar dados");
    
    while ($registro = mysqli_fetch_array($resultado)){
        $num = $registro ['numero'];
        $data = date('d/m/Y', strtotime($registro["data"]));
        $prazo = date('d/m/Y', strtotime($registro["prazo_entrega"]));        
        $cond_pagto = $registro ['cond_pagto'];
        $cod_cli = $registro ['cod_cliente'];
        $cliente = $registro ['Cliente'];
        $cod_vende = $registro ['cod_vendedor'];
        $vendedor = $registro ['Vendedor'];    
?>

<tr>
    <td><?=$num ?></td>
    <td><?=$data ?></td>
    <td><?=$prazo ?></td>    
    <td><?=$cond_pagto ?></td>
    <td><?=$cod_cli ?></td>
    <td><?=$cliente ?></td>
    <td><?=$cod_vende ?></td>
    <td><?=$vendedor ?></td>
</tr>

<?php
}
mysqli_close($conn);
?>



