<?php
    session_start();
    include('../../connection/connection.php');

    $numero = filter_input(INPUT_GET,'numero',FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT v.*, c.nome AS nome_cliente, vd.nome AS nome_vendedor FROM vendas v INNER JOIN cliente c ON v.cod_cliente = c.codigo INNER JOIN vendedor vd ON v.cod_vendedor = vd.cod WHERE numero = '$numero'";
    $resultado = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($resultado);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Venda</title>
    <link href="../../node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <button class="btn btn-outline-primary" type="button" id="btn-back">
                    <i class="bi bi-arrow-left-circle"></i>
                    Voltar
                </button>                
            </div>  
            <h1>
                Deletar Venda
            </h1>
        </div>
        <div class="row">
            <div class="form-control">
                <form action="php/delete.php" method="post">
                    <input type="hidden" name="numero" value="<?= $row['numero'] ?>" required>
                    <div class="mb-3">
                        <label for="" class="form-label"><b>Codigo:</b> <?= $row['numero'] ?></label>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"><b>Data:</b> <?= $row['data'] ?></label>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"><b>Prazo de entrega:</b> <?= $row['prazo_entrega'] ?></label>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"><b>Metodo de pagamento:</b> <?= $row['cond_pagto'] ?></label>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"><b>Cliente:</b> <?= $row['nome_cliente'] ?></label>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"><b>Vendedor:</b> <?= $row['nome_vendedor'] ?></label>
                    </div>

                    <div class=" md-3">
                        <input type="submit" value="Deletar" class="btn btn-danger">
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>