<?php
    include('../../../connection/connection.php');
    if (session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    // CADASTRO DA VENDA
    $data = filter_input(INPUT_POST,'data',FILTER_SANITIZE_STRING);
    $prazo_entrega = filter_input(INPUT_POST, 'prazo_entrega', FILTER_SANITIZE_STRING);
    $cond_pagto =  filter_input(INPUT_POST,'cond_pagto',FILTER_SANITIZE_STRING);
    $cod_cliente = filter_input(INPUT_POST, 'cod_cliente', FILTER_SANITIZE_NUMBER_INT);
    $cod_vendedor =  filter_input(INPUT_POST,'cod_vendedor',FILTER_SANITIZE_NUMBER_INT);
    $total = $_SESSION['total_venda'];
    $queryV = "INSERT INTO vendas (data, prazo_entrega, cod_vendedor,  cond_pagto, cod_cliente, total) 
                    VALUES ('$data', '$prazo_entrega', '$cod_vendedor',  '$cond_pagto', '$cod_cliente', '$total')";
    $resultV = mysqli_query($conn, $queryV);

    // CONSULTA A ULTIMA VENDA CADASTRADA 
    $queryLastV = "SELECT * FROM vendas ORDER BY numero DESC LIMIT 1;";
    $resultLastV = mysqli_query($conn, $queryLastV);
    $rowLastV = mysqli_fetch_array($resultLastV);

    // PEGA O NUMERO DA ULTIMA VENDA CADASTRADA
    $numV = $rowLastV['numero'];

    // LOOP PARA PERCORRER O ARRAY DOS ITENS DA VENDA
    foreach ($_SESSION['produtos'] as $index => $produto) {
        $prod = $produto['produto']; 
        $descri = $produto['descricao'];  
        $unid = $produto['unid']; 
        $vlrUnit = $produto['vlrUnit'];     
        $qtde = $produto['qtde'];  
        $subtotal = $produto['subtotal']; 
        $estoque = $produto['estoque'];   

        // DEBITA A QUANTIDADE COMPRADA DO ESTOQUE
        $qtdeEstAtt = $estoque - $qtde;
        
        // ATUALIZA O ESTOQUE ATUAL
        $queryUP = "UPDATE produtos 
                    SET qtd_estoque ='$qtdeEstAtt'
                    WHERE cod = '$prod'";
        $resultUP = mysqli_query($conn, $queryUP) or die("Erro ao retornar dados UP");

        // REALIZA O CADASTRO DOS ITENS REFERENTE A VENDA
        $queryIV = "INSERT INTO itens_vendas (cod_produto, numero_venda, quant_vendida, subtotal) 
                        VALUES ('$prod', $numV, '$qtde',  '$subtotal')";
        $resultIV = mysqli_query($conn, $queryIV);   

    }
    unset($_SESSION['produtos']);
    unset($_SESSION['total_venda']);
    
    if (mysqli_insert_id($conn)) {
        $_SESSION['msg'] = '
        <div class="alert alert-success alert-dismissible fade show" id="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>
            <b>Sucesso!</b> Venda cadastrada.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        header('location: ../listagem.php');
    } else {
        $_SESSION['msg'] = '
        <div class="alert alert-danger alert-dismissible fade show" id="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <b>Falha!</b> Venda não cadastrada.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        header('location: ../listagem.php');
    }
    mysqli_close($conn);
?>