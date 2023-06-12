<?php
    use Dompdf\Dompdf;
    require_once("../../dompdf/autoload.inc.php");

    // Função para buscar os dados do banco de dados
    $data1 = $_POST['input1'];
    $data2 = $_POST['input2'];  

    // Conexão com o banco de dados (substitua pelas suas informações de conexão)
    include('../../connection/connection.php');
    
    // Consulta para buscar as categorias
    $consultaVendas = "SELECT vd.*, v.nome AS Vendedor, c.nome AS Cliente
                            FROM vendas vd
                            INNER JOIN vendedor v ON v.cod = vd.cod_vendedor
                            INNER JOIN cliente c ON c.codigo = vd.cod_cliente    
                            WHERE data BETWEEN '$data1' AND '$data2'
                            ORDER BY vd.numero";
    $resultadoVendas = $conn->query($consultaVendas);

    // Consulta para buscar os produtos
    // $consultaItensVendas = "SELECT * FROM list_itens_venda WHERE numero_venda = '$num'";
    $resultadoItensVendas = $conn->query($consultaItensVendas);

    // Fechar a conexão com o banco de dados
    mysqli_close($conn);
    
    while ($registro = $resultadoVendas->fetch_assoc()){
        $num = $registro ['numero'];
        $data = date('d/m/Y', strtotime($registro["data"]));
        $prazo = date('d/m/Y', strtotime($registro["prazo_entrega"]));        
        $cond_pagto = $registro ['cond_pagto'];
        $cod_cli = $registro ['cod_cliente'];
        $cliente = $registro ['Cliente'];
        $cod_vende = $registro ['cod_vendedor'];
        $vendedor = $registro ['Vendedor'];    
        $totalV = $registro ['total'];   
        
        
    }
?>
