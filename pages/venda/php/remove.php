<?php
    session_start();
    $index = $_POST['index'];

    if (isset($_SESSION['produtos'][$index])) {
        unset($_SESSION['produtos'][$index]);
        $_SESSION['produtos'] = array_values($_SESSION['produtos']); // Reindexa os produtos após a remoção
    }

    // Retorne a tabela de produtos atualizada
    if (isset($_SESSION['produtos']) && count($_SESSION['produtos']) > 0) {

        $total = 0;
        
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
        }

        echo "<tr class='total'>";
        echo "<td>Total:</td>";
        echo "<td>R$ $total</td>";
        echo "<td></td>";
        echo "</tr>";           
    } else {
        echo "<p>Nenhum produto adicionado.</p>";
    }
?>