<?php 
    include('../../../connection/connection.php');
    if (session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    $_SESSION['total_venda'] = 0;
    $prod = $_POST['inputP'];  
    $qtde = $_POST['inputQ'];  

    $sql = "SELECT * FROM produtos WHERE cod='$prod'";   
    $resultado = mysqli_query($conn,$sql) or die("Erro ao retornar dados");
    $registro = mysqli_fetch_array($resultado);

    $total = 0;
    $item = 0;
    $estoque = $registro['qtd_estoque'];
    $descri = $registro['nome'];
    $unid = $registro['unidade_medida'];
    $vlrUnit = $registro['preco'];

    $subtotal = $vlrUnit * $qtde;
    // Adiciona o produto à sessão de produtos
    $_SESSION['produtos'][] = [
        'item' => $item +1,
        'produto' => $prod,
        'descricao' => $descri,
        'unid' => $unid,
        'vlrUnit' => $vlrUnit,
        'qtde' => $qtde,
        'subtotal' => $subtotal,
        'estoque' => $estoque
    ];

    // Verifica se existem produtos na sessão
    if (isset($_SESSION['produtos']) && count($_SESSION['produtos']) > 0) {

        // Exibe os produtos adicionados
        foreach ($_SESSION['produtos'] as $index => $produto) {
            echo "<tr>";
            echo "<td>{$index}</td>";
            echo "<td>{$produto['produto']}</td>";
            echo "<td>{$produto['descricao']}</td>"; 
            echo "<td>{$produto['unid']}</td>";  
            echo "<td>R$ {$produto['vlrUnit']}</td>";   
            echo "<td>{$produto['qtde']}</td>";    
            echo "<td>R$ {$produto['subtotal']}</td>";                                 
            echo "<td>";
            echo "<input type='hidden' name='index' value='$index'>";
            echo "<button type='button' class='btn btn-danger' onclick=\"removerProduto($index)\">Remover</button>";
            echo "</td>";
            echo "</tr>";

            $total += $produto['subtotal'];
            $_SESSION['total_venda'] = $total;
        }      
        echo "<tr>";
        echo "<td></td>"; 
        echo "<td></td>";  
        echo "<td></td>"; 
        echo "<td></td>"; 
        echo "<td></td>";               
        echo "<td>Total</td>";
        echo "<td>R$ $total</td>";
        echo "<td></td>";
        echo "</tr>";
    } else {
        echo "<p>Nenhum produto adicionado.</p>";
    };

    mysqli_close($conn);
?>