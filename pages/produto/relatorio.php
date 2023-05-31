<?php
    include('../../connection/connection.php');
    if (session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    $query = "SELECT * FROM produtos";
    $result = mysqli_query($conn, $query);
    $row = "";

    while ($dados = mysqli_fetch_array($result)){
        $row ="<tr><td>".$dados['nome']."</td><td>".$dados['id_categoria']."</td><td>";
    }

    use Dompdf\Dompdf;

    require_once("../../dompdf/autoload.inc.php");
    $dompdf = new DOMPDF();

    $dompdf->loadHtml('
            <h1>Relatório de Produtos</h1>
            <hr>
            <table width="100%">
                <tr>
                    <td>Produto</td>
                    <td>Categoria</td>
                </tr>'.$row.'
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