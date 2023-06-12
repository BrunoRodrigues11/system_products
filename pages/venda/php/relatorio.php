<?php

    $datainicial=$_POST["data-inicial"];
    $datafinal=$_POST["data-final"];

    $msg_erro = "Nenhum registro encontrado.";
    use Dompdf\Dompdf;
    require_once("../../../dompdf/autoload.inc.php");
    
    // Função para buscar os dados do banco de dados
    function buscarDadosDoBanco() {
        // Conexão com o banco de dados (substitua pelas suas informações de conexão)
        include('../../../connection/connection.php');

        global $datainicial;
        global $datafinal;
        
        if (empty($datainicial) AND empty($datafinal)){
            $sql = "SELECT V.numero, V.data, V.prazo_entrega, V.cond_pagto, C.nome AS cliente, VD.nome AS vendedor, P.nome AS produtos FROM itens_vendas IV INNER JOIN vendas V ON V.numero= IV.numero_venda INNER JOIN cliente C ON C.codigo= V.cod_cliente INNER JOIN vendedor VD ON V.cod_vendedor= VD.cod INNER JOIN produtos P ON IV.cod_produto= P.cod";
            $sqldatas = "SELECT V.data, V.numero FROM vendas V";   
        }elseif (empty($datainicial) AND !empty($datafinal)){
            $sql = "SELECT V.numero, V.data, V.prazo_entrega, V.cond_pagto, C.nome AS cliente, VD.nome AS vendedor, P.nome AS produtos FROM itens_vendas IV INNER JOIN vendas V ON V.numero= IV.numero_venda INNER JOIN cliente C ON C.codigo= V.cod_cliente INNER JOIN vendedor VD ON V.cod_vendedor= VD.cod INNER JOIN produtos P ON IV.cod_produto= P.cod WHERE '".$datafinal."' >= V.data";
            $sqldatas = "SELECT V.data, V.numero FROM vendas V WHERE '".$datafinal."' >= V.data";
        }elseif (!empty($datainicial) AND empty($datafinal)){
            $sql = "SELECT V.numero, V.data, V.prazo_entrega, V.cond_pagto, C.nome AS cliente, VD.nome AS vendedor, P.nome AS produtos FROM itens_vendas IV INNER JOIN vendas V ON V.numero= IV.numero_venda INNER JOIN cliente C ON C.codigo= V.cod_cliente INNER JOIN vendedor VD ON V.cod_vendedor= VD.cod INNER JOIN produtos P ON IV.cod_produto= P.cod WHERE '".$datainicial."' <= V.data";
            $sqldatas = "SELECT V.data, V.numero FROM vendas V WHERE '".$datainicial."' <= V.data";
        }elseif (!empty($datainicial) AND !empty($datafinal)){
            $sql = "SELECT V.numero, V.data, V.prazo_entrega, V.cond_pagto, C.nome AS cliente, VD.nome AS vendedor, P.nome AS produtos FROM itens_vendas IV INNER JOIN vendas V ON V.numero= IV.numero_venda INNER JOIN cliente C ON C.codigo= V.cod_cliente INNER JOIN vendedor VD ON V.cod_vendedor= VD.cod INNER JOIN produtos P ON IV.cod_produto= P.cod WHERE '".$datainicial."' <= V.data AND '".$datafinal."' >= V.data";
            $sqldatas = "SELECT V.data, V.numero FROM vendas V WHERE '".$datainicial."' <= V.data AND '".$datafinal."' >= V.data";
        }
        // echo $sql;

        $resultadoProdutos = mysqli_query($conn,$sql) or die("Erro ao retornar dados");
        $resultadodatas = mysqli_query($conn,$sqldatas) or die("Erro ao retornar dados");
        
        // Fechar a conexão com o banco de dados
        mysqli_close($conn);
    
        // Montar arrays com os dados
        $datas = [];
        while ($row = $resultadodatas->fetch_assoc()) {
            $datas[] = [
                'numero' => $row['numero'],
                'data' => $row['data'],
            ];
        }
        
        
        $produtos = [];
        while ($row = $resultadoProdutos->fetch_assoc()) {
            $produtos[] = [
                'numero' => $row['numero'],
                'data' => $row['data'],
                'prazo_entrega' => $row['prazo_entrega'],  
                'cond_pagto' => $row['cond_pagto'],      
                'cliente' => $row['cliente'],
                'vendedor' => $row['vendedor'],                   
                'produtos' => $row['produtos'],                             
            ];
        } 

        // Retornar os dados
        // print_r($datas) ;
        // print_r($produtos) ;
        return ['datas' => $datas, 'produtos' => $produtos];
    }

    // Função para gerar o relatório de produtos por categoria
    function gerarRelatorio($datas, $produtos) {
        // Criar uma nova instância do Dompdf
        $dompdf = new Dompdf();
        
        $dompdf->setBasePath("../../../node_modules/bootstrap/css/bootstrap.min.css");
        // Iniciar o conteúdo do documento HTML
        $html = '<html><head>';     
        $html .= '</head><body>
        <style>
            td {
            text-align: center;
            }
        </style>';
        
        // Loop pelas data
        foreach ($datas as $index => $data) {                
            $html .= '<h1> Relatório de vendas - '.$data['data'].' - Venda Nº '.$data['numero'].'</h1>';
            $html .= '<hr>';                        
            $html .= '<table width="100%">';
            $html .= '<tr>';
            $html .= '<th>Número</th>';
            $html .= '<th>Data</th>';
            $html .= '<th>Prazo de Entrega</th>';
            $html .= '<th>Condição do pagamento</th>';
            $html .= '<th>cliente</th>';
            $html .= '<th>Vendedor</th>';         
            $html .= '<th>Produto</th>';
            $html .= '</tr>';
            
            // Loop pelos produtos da categoria atual
            foreach ($produtos as $produto) {
                if ($produto['numero'] == $data['numero']) {
                    $html .= '<tr>';
                    $html .= '<td>'.$produto['numero'].'</td>';
                    $html .= '<td>'.$produto['data'].'</td>';
                    $html .= '<td>'.$produto['prazo_entrega'].'</td>';
                    $html .= '<td>'.$produto['cond_pagto'].'</td>';
                    $html .= '<td>'.$produto['cliente'].'</td>';
                    $html .= '<td>'.$produto['vendedor'].'</td>';               
                    $html .= '<td>'.$produto['produtos'].'</td>';
                    $html .= '</tr>';
                }
            }
            
            $html .= '</table>';
            $html .= '<div style="page-break-after: always;"></div>'; // Quebra de página
        }
    
        // Fechar o conteúdo do documento HTML
        $html .= '</body></html>';
        // echo $html;
        // Carregar o conteúdo HTML no Dompdf
        $dompdf->loadHtml($html);
    
        // Definir as opções de renderização
        $dompdf->setPaper('A4', 'landscape');
    
        // Renderizar o documento HTML para PDF
        $dompdf->render();
    
        // Gerar a saída do PDF (fazer download ou salvar em um arquivo)
        $dompdf->stream(
            "Relatorio_Vendas.pdf",
            array(
                "Attachment" => false
            )
        );
    }
  
    // Buscar os dados do banco de dados
    $dados = buscarDadosDoBanco();
    // print_r($dados);
    // Gerar o relatório
    gerarRelatorio($dados['datas'], $dados['produtos']);
?>
