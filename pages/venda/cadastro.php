<?php
    session_start();
    include('../../connection/connection.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Cliente</title>
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
            <h1>
            <div class="col-md-3">
                <button class="btn btn-outline-primary" type="button" id="btn-back">
                    <i class="bi bi-arrow-left-circle"></i>
                    Voltar
                </button>                
            </div>  
                Nova Venda
            </h1>
        </div>
        <div class="row">
            <div class="form-control">
                <form action="php/insert.php" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Data:</label>
                        <input type="date" name="data" class="form-control" maxlength="100" required>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Prazo de Entrega:</label>
                        <input type="date" name="prazo_entrega" class="form-control" maxlength="100" required>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Metodo de pagamento:</label>
                        <select name='cond_pagto' class="form-select">
                            <option value="pix">Pix</option>
                            <option value="dinheiro">Dinheiro</option>
                            <option value="debito">Cartão de debito</option>
                            <option value="credito">Cartão de credito</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <?php 
                    $queryCliente = "SELECT * FROM cliente";
                    $resultadoCliente = mysqli_query($conn, $queryCliente);
                    if (mysqli_num_rows($resultadoCliente) > 0) { ?>
                        <label for="" class="form-label">Cliente:</label>
                        <select name='cod_cliente' class="form-select">
                            <?php foreach ($resultadoCliente as $rowCliente) { ?>
                            <option value="<?= $rowCliente['codigo'] ?>"> <?= $rowCliente['nome'] ?></option>
                            <?php } ?>
                        </select>
                        <?php } else { ?>
                        <select name='cod_cliente' class="form-select" hidden required></select>
                        <label for="" class="form-label">Nenhum cliente encontrado.</label>
                        <?php } ?>
                    </div>


                    <div class="mb-3">
                        <?php 
                    $queryVendedor = "SELECT * FROM vendedor";
                    $resultadoVendedor = mysqli_query($conn, $queryVendedor);
                    if (mysqli_num_rows($resultadoVendedor) > 0) { ?>
                        <label for="" class="form-label">Vendedor:</label>
                        <select name='cod_vendedor' class="form-select">
                            <?php foreach ($resultadoVendedor as $rowVendedor) { ?>
                            <option value="<?= $rowVendedor['cod'] ?>"> <?= $rowVendedor['nome'] ?></option>
                            <?php } ?>
                        </select>
                        <?php } else { ?>
                        <select name='cod_vendedor' class="form-select" hidden required></select>
                        <label for="" class="form-label">Nenhum vendedor encontrado.</label>
                        <?php } ?>
                    </div>

                    <div class=" md-3">
                        <input type="submit" value="Enviar" class="btn btn-success">
                        <input type="reset" value="Limpar" class="btn btn-primary">
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>