<?php
    use Dompdf\Dompdf;
    require_once("../../dompdf/autoload.inc.php");
    
    // Função para buscar os dados do banco de dados
    function buscarDadosDoBanco() {
        // Conexão com o banco de dados
        include('../../connection/connection.php');
    
        // Consulta para buscar as categorias
        $consultaCategorias = "SELECT descricao FROM categoria ORDER BY descricao";
        $resultadoCategorias = $conn->query($consultaCategorias);
    
        // Consulta para buscar os produtos
        $consultaProdutos = "SELECT * FROM list_prod_cat";
        $resultadoProdutos = $conn->query($consultaProdutos);
    
        // Fechar a conexão com o banco de dados
        mysqli_close($conn);
    
        // Montar arrays com os dados
        $categorias = [];
        while ($row = $resultadoCategorias->fetch_assoc()) {
            $categorias[] = $row['descricao'];
        }
    
        $produtos = [];
        while ($row = $resultadoProdutos->fetch_assoc()) {
            $produtos[] = [
                'cod' => $row['cod'],
                'produto' => $row['nome'],
                'preco' => $row['preco'],  
                'estoqueA' => $row['qtd_estoque'],      
                'estoqueM' => $row['qtd_estoque_min'],
                'um' => $row['unidade_medida'],                   
                'categoria' => $row['categoria'],                             
            ];
        } 

        // Retornar os dados
        return ['categorias' => $categorias, 'produtos' => $produtos];
    }

    // Função para gerar o relatório de produtos por categoria
    function gerarRelatorio($categorias, $produtos) {
        // Criar uma nova instância do Dompdf
        $dompdf = new Dompdf();

        $dompdf->setBasePath("../../node_modules/bootstrap/css/bootstrap.min.css");
        // Iniciar o conteúdo do documento HTML
        $html = '<html><head>';     
        $html .= '</head><body>';

         // Loop pelas categorias
         foreach ($categorias as $categoria) {                
            $html .= '<h1> Relatório de Produtos - '.$categoria.'</h1>';
            $html .= '<hr>';                        
            $html .= '<table width="100%">';
            $html .= '<tr>';
            $html .= '<th>Código</th>';
            $html .= '<th>Descrição</th>';
            $html .= '<th>Preço Unit.</th>';
            $html .= '<th>Estoque Atual</th>';
            $html .= '<th>Estoque Min</th>';
            $html .= '<th>Unid.</th>';         
            $html .= '<th>Categoria</th>';
            $html .= '</tr>';

            // Loop pelos produtos da categoria atual
            foreach ($produtos as $produto) {
                if ($produto['categoria'] == $categoria) {
                    $html .= '<tr>';
                    $html .= '<td>'.$produto['cod'].'</td>';
                    $html .= '<td>'.$produto['produto'].'</td>';
                    $html .= '<td> R$ '.$produto['preco'].'</td>';
                    $html .= '<td>'.$produto['estoqueA'].'</td>';
                    $html .= '<td>'.$produto['estoqueM'].'</td>';
                    $html .= '<td>'.$produto['um'].'</td>';               
                    $html .= '<td>'.$produto['categoria'].'</td>';
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
            "Relatorio_produtos.pdf",
            array(
                "Attachment" => false
            )
        );
    }
  
    // Buscar os dados do banco de dados
    $dados = buscarDadosDoBanco();

    // Gerar o relatório
    gerarRelatorio($dados['categorias'], $dados['produtos']);
?>
