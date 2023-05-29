<?php
    include('../../connection/connection.php');
    if (session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    $queryItensVenda = "SELECT * FROM cont_prod";
    $resultadoItensVenda = mysqli_query($conn, $queryItensVenda);
    $rowQItensVenda = mysqli_fetch_array($resultadoItensVenda);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Venda</title>
    <link href="../../node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../node_modules/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="../../css/style.css" rel="stylesheet">
</head>

<body>
    <?php
        include("../../components/navbar.php");
    ?>
    <div class="container">
        <div class="row pt-3">
            <div class="form-control">
                <div class="row d-flex align-items-start">
                    <div class="col-md-2 btn-back">
                        <button class="btn btn-outline-primary" type="button" id="btn-back">
                            <i class="bi bi-arrow-left-circle"></i>
                            Voltar
                        </button>  
                    </div>
                    <div class="col-md-6">            
                        <h3>
                            Nova Venda
                        </h3>                
                    </div>                
                </div> 
                <form action="php/insert.php" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="form-label">Data da Venda</label>
                            <input type="date" name="data" class="form-control" maxlength="100" required>
                        </div>      
                        <div class="col-md-6">
                            <label for="" class="form-label">Prazo de Entrega</label>
                            <input type="date" name="prazo_entrega" class="form-control" maxlength="100" required>
                        </div>                   
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="form-label">Cliente</label>
                            <?php 
                                $queryCliente = "SELECT * FROM cliente";
                                $resultadoCliente = mysqli_query($conn, $queryCliente);
                                if (mysqli_num_rows($resultadoCliente) > 0) { ?>
                                <input class="form-control" list="datalistOptions" id="estado" name="estado" placeholder="Selecione o Cliente">
                                    <datalist id="datalistOptions">
                                        <?php foreach ($resultadoCliente as $rowCliente) { ?>
                                        <option value="<?= $rowCliente['codigo'] ?>"> <?= $rowCliente['nome'] ?></option>
                            <?php } ?>
                                    </datalist>
                            <?php } else { ?>
                                    <select name='cod_cliente' class="form-select" hidden required></select>
                                    <label for="" class="form-label">Nenhum cliente encontrado.</label>
                            <?php } ?>                    
                        </div>  
                        <div class="col-md-6">
                            <?php 
                                $queryVendedor = "SELECT * FROM vendedor";
                                $resultadoVendedor = mysqli_query($conn, $queryVendedor);
                                if (mysqli_num_rows($resultadoVendedor) > 0) { ?>
                                    <label for="" class="form-label">Vendedor</label>
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
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="form-label">Metodo de pagamento</label>
                            <select name='cond_pagto' class="form-select">
                                <option value="pix">Pix</option>
                                <option value="dinheiro">Dinheiro</option>
                                <option value="debito">Cartão de debito</option>
                                <option value="credito">Cartão de credito</option>
                            </select>
                        </div>                        
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Abrir Venda" class="btn btn-success">
                        </div>                        
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/main.js"></script>
</body>

</html>