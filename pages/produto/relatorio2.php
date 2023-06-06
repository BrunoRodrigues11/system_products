<?php
    include('../../connection/connection.php');

    $sql = "SELECT * FROM list_prod_cat";
    $res = $conn->query($sql) or die("Erro ao retornar dados");
    $html = "";
    if($res->num_rows > 0){
        $html .= "<h1>Relatório de Produtos</h1>";
        $html .= "<hr>";
        $html .= "<table>";
        $html .= "<tr>";
        $html .= "<td>Produto</td>";
        $html .= "<td>Categoria</td>";
        $html .= "</tr>";
        while($row = $res->fetch_object()){
            $html .= "<tr>";
            $html .= "<td>" .$row->produto."</td>";
            $html .= "<td>" .$row->categoria."</td>";
            $html .= "</tr>";
        }
        $html .= "</table>";
    }else{
        print 'Nenhum dado registrado';
    }

    // print $html;

    use Dompdf\Dompdf;
    require_once '../../dompdf/autoload.inc.php';

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->render();
    $dompdf->stream(
        "Relatorio_produtos.pdf",
        array(
            "Attachment" => false
        )
    );

?>