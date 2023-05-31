<?php
    include('../../connection/connection.php');
    if (session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    $sql = 'SELECT * FROM list_prod_cat';
    $resultado = mysqli_query($conn, $sql) or die("Erro ao retornar dados");
    $row = "";
    while ($registro = mysqli_fetch_array($resultado)){
        $row ="<tr>
                    <td>".$registro['produto']."</td>
                    <td>".$registro['categoria']."</td>
                <tr>";
        // echo "'$row'<br>";
    }

    require_once("../../dompdf/autoload.inc.php");
    use Dompdf\Dompdf;

    $dompdf = new DOMPDF();

    $dompdf->loadHtml('
            <h1>Relatório de Produtos</h1>
            <hr>
            <table width="100%">
                <tr>
                    <td>Produto</td>
                    <td>Categoria</td>
                </tr>
                '.$row.'           
            </table>            
    ');

    $dompdf->render();
    $dompdf->stream(
        "Relatorio_produtos.pdf",
        array(
            "Attachment" => false
        )
        );
?>