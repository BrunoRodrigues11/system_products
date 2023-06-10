<?php
    include('../../../connection/connection.php');
    if (session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    $cod = filter_input(INPUT_POST,'cod',FILTER_SANITIZE_NUMBER_INT);
    $nome =  filter_input(INPUT_POST,'nome',FILTER_SANITIZE_STRING);
    $preco =  filter_input(INPUT_POST,'preco',FILTER_VALIDATE_FLOAT);
    $qtd_estoque = filter_input(INPUT_POST, 'estoque_atual', FILTER_SANITIZE_NUMBER_INT);
    $qtd_estoque_min = filter_input(INPUT_POST, 'estoque_min', FILTER_SANITIZE_NUMBER_INT);
    $unidade_medida =  filter_input(INPUT_POST,'unidade_medida',FILTER_SANITIZE_STRING);
    $id_categoria =  filter_input(INPUT_POST,'id_categoria',FILTER_SANITIZE_NUMBER_INT);
    $query = "UPDATE produtos 
                SET nome='$nome', preco='$preco', qtd_estoque='$qtd_estoque', qtd_estoque_min='$qtd_estoque_min', unidade_medida='$unidade_medida', id_categoria='$id_categoria' 
                WHERE cod = '$cod'";
    $resultado = mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn)) {
        $_SESSION['msg'] = '
        <div class="alert alert-success alert-dismissible fade show" id="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>
            <b>Sucesso!</b> Produto alterado.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        header('location: ../listagem.php');
    } else {
        $_SESSION['msg'] = '
        <div class="alert alert-danger alert-dismissible fade show" id="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <b>Falha!</b> Produto não alterado.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        header('location: ../listagem.php');
    }
    mysqli_close($conn);
?>