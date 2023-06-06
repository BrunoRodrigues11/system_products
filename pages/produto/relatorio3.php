<?php
    include('../../connection/connection.php');
    // Incluir a biblioteca dompdf
    require_once '../../dompdf/autoload.inc.php';
    use Dompdf\Dompdf;

    // Função para gerar o relatório de produtos por categoria
    function gerarRelatorio($categorias, $produtos) {
        // Criar uma nova instância do Dompdf
        $dompdf = new Dompdf();

        // Iniciar o conteúdo do documento HTML
        $html = '<html><body>';

        // Loop pelas categorias
        foreach ($categorias as $categoria) {
            $html .= '<h1>' . $categoria . '</h1>';
            $html .= '<table><tr><th>Nome</th><th>Preço</th></tr>';

            // Loop pelos produtos da categoria atual
            foreach ($produtos as $produto) {
                if ($produto['categoria'] == $categoria) {
                    $html .= '<tr><td>' . $produto['nome'] . '</td><td>' . $produto['preco'] . '</td></tr>';
                }
            }

            $html .= '</table>';
            $html .= '<div style="page-break-after: always;"></div>'; // Quebra de página
        }

        // Fechar o conteúdo do documento HTML
        $html .= '</body></html>';

        // Carregar o conteúdo HTML no Dompdf
        $dompdf->loadHtml($html);

        // Definir as opções de renderização
        $dompdf->setPaper('A4', 'portrait');

        // Renderizar o documento HTML para PDF
        $dompdf->render();

        // Gerar a saída do PDF (fazer download ou salvar em um arquivo)
        //   $dompdf->stream('relatorio_produtos.pdf');
        $dompdf->stream(
            "Relatorio_produtos.pdf",
            array(
                "Attachment" => false
            )
        );
    }

    // Dados de exemplo
    $categorias = ['Eletrônicos', 'Roupas', 'Acessórios'];
    $produtos = [
        ['nome' => 'Smartphone', 'preco' => 999.99, 'categoria' => 'Eletrônicos'],
        ['nome' => 'Camiseta', 'preco' => 29.99, 'categoria' => 'Roupas'],
        ['nome' => 'Relógio', 'preco' => 199.99, 'categoria' => 'Acessórios'],
        ['nome' => 'Notebook', 'preco' => 1499.99, 'categoria' => 'Eletrônicos'],
        ['nome' => 'Calça Jeans', 'preco' => 59.99, 'categoria' => 'Roupas'],
        ['nome' => 'Óculos de Sol', 'preco' => 79.99, 'categoria' => 'Acessórios'],
    ];

    // Gerar o relatório
    gerarRelatorio($categorias, $produtos);

?>
