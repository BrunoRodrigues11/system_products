<?php 
    include('../../../connection/connection.php');
    if (session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    $numV = $_POST['input']; 
    $msg_erro = "Nenhum registro encontrado.";

    if (empty($numV)){
        $sql = "SELECT vd.*, v.nome AS Vendedor, c.nome AS Cliente
                    FROM vendas vd
                    INNER JOIN vendedor v ON v.cod = vd.cod_vendedor
                    INNER JOIN cliente c ON c.codigo = vd.cod_cliente    
                    ORDER BY vd.numero";   
    }elseif (!empty($numV)){
        $sql = "SELECT vd.*, v.nome AS Vendedor, c.nome AS Cliente
                    FROM vendas vd
                    INNER JOIN vendedor v ON v.cod = vd.cod_vendedor
                    INNER JOIN cliente c ON c.codigo = vd.cod_cliente    
                    WHERE numero = '$numV'
                    ORDER BY vd.numero";
        echo $msg_erro;
    }
    $resultado = mysqli_query($conn,$sql) or die("Erro ao retornar dados");
    
    $cont = 0;
    while ($registro = $resultado->fetch_assoc()){
        $conteudoExtraID = "conteudo-extra-" . ($cont += 1);
        $num = $registro ['numero'];
        $data = date('d/m/Y', strtotime($registro["data"]));
        $prazo = date('d/m/Y', strtotime($registro["prazo_entrega"]));        
        $cond_pagto = $registro ['cond_pagto'];
        $cod_cli = $registro ['cod_cliente'];
        $cliente = $registro ['Cliente'];
        $cod_vende = $registro ['cod_vendedor'];
        $vendedor = $registro ['Vendedor'];    
        $totalV = $registro ['total'];            
?>

<tr class='linha-expansivel' data-target="<?= $conteudoExtraID ?>">
    <td>
        <button type='button' class='btn btn-primary btnExpand' onclick="expandRow(<?= $num ?>)" >
            <i class="bi bi-plus" id="buttonExpand"></i>            
        </button>
    </td>    
    <td><?=$num ?></td>
    <td><?=$data ?></td>
    <td><?=$prazo ?></td>    
    <td><?=$cond_pagto ?></td>
    <td><?=$cod_cli ?></td>
    <td><?=$cliente ?></td>
    <td><?=$cod_vende ?></td>
    <td><?=$vendedor ?></td>
</tr>
<tr class='conteudo-extra <?= $conteudoExtraID ?>'>
    <td colspan="10">
        <div class="bg-dark">
            <table id="resultTable1" style=""  class="table table-responsive table-hover text-bg-light align-middle">
                <thead><tr>                      
                    <th>Item</th>
                    <th>Código</th>
                    <th>Produto</th>
                    <th>Unid.</th>
                    <th>Vr. Unitário</th>
                    <th>Quantidade</th>
                    <th>Sub Total</th>                               
                </tr></thead>
                <tbody>
                    <?php
                        $sqlIV = "SELECT * FROM list_itens_venda WHERE numero_venda = '$num'";
                        $resultadoIV = mysqli_query($conn,$sqlIV) or die(mysqli_connect_error());

                        while ($registroIV = mysqli_fetch_array($resultadoIV)){
                            $item = $registroIV ['num_item'];
                            $cod = $registroIV["cod"];
                            $nome = $registroIV["nome"];        
                            $um = $registroIV ['unidade_medida'];
                            $preco = $registroIV ['preco'];
                            $qtde = $registroIV ['quant_vendida'];
                            $total = $registroIV ['total'];        
                    ?>
                    <tr>  
                        <td><?=$item ?></td>
                        <td><?=$cod ?></td>
                        <td><?=$nome ?></td>    
                        <td><?=$um ?></td>
                        <td><?=$preco ?></td>
                        <td><?=$qtde ?></td>
                        <td><?=$total ?></td>     
                    </tr>
                    <?php } ?>
                    <tr>
                        <td></td>                            
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td>R$ <?= $registro ['total'] ?></td>                                        
                    </tr>
                </tbody>
            </table>         
        </div>        
    </td>                    
</tr>
<?php
    }
    mysqli_close($conn);
?>



