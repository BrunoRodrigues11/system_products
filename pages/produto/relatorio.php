<?php
    include('../../connection/connection.php');
    if (session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    
    $sql = "SELECT * FROM list_prod_cat WHERE categoria LIKE '%Frutas%'";
    $resultado = mysqli_query($conn,$sql) or die("Erro ao retornar dados");
    
    $row ="";

    while ($registro = mysqli_fetch_array($resultado)){
        $categoria = $registro['categoria'];
        $produto = $registro['produto'];

        $row.="<tr><td>".$produto."</td><td>".$categoria."</td><tr><br>";
        // echo "'$row'<br>";
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
                </tr>'.$row.'</table>');

    $dompdf->render();
    
    $dompdf->stream(
        "Relatorio_produtos.pdf",
        array(
            "Attachment" => false
        )
    );
?>