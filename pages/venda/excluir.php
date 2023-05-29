<?php
    include('../../connection/connection.php');
    if (session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

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
                            Deletar Venda
                        </h3>                
                    </div>                
                </div>  
                <form action="php/delete.php" method="post">
                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="numero" value="<?= $row['numero'] ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label"><b>Codigo:</b> <?= $row['numero'] ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label"><b>Data:</b> <?= $row['data'] ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label"><b>Prazo de entrega:</b> <?= $row['prazo_entrega'] ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label"><b>Metodo de pagamento:</b> <?= $row['cond_pagto'] ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label"><b>Cliente:</b> <?= $row['nome_cliente'] ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label"><b>Vendedor:</b> <?= $row['nome_vendedor'] ?></label>
                        </div>
                    </div>
                    <br>
                    <div class="row d-flex align-items-start">
                        <div class="col-md-6">            
                            <h3>
                                Itens da Venda - Nº <?= $row['numero'] ?>
                            </h3>                
                        </div>                
                    </div> 
                    <table class="table table-responsive table-hover text-bg-light align-middle">
                        <thead>
                            <tr>
                                <th>Item</th>                                
                                <th>Código</th>
                                <th>Produto</th>
                                <th>Unidade Medida</th>
                                <th>Preço</th>
                                <th>Qtde</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <?php
                            $sql = "SELECT * FROM list_itens_venda WHERE numero_venda = $numero";
                            $resu = mysqli_query($conn,$sql) or die(mysqli_connect_error());
                            if (mysqli_num_rows($resu) > 0) {
                                while ($reg = mysqli_fetch_array($resu)){
                                ?>
                                <tbody>
                                    <tr>
                                        <td><?= $reg["num_item"] ?></td>                                
                                        <td><?= $reg["cod"] ?></td>
                                        <td><?= $reg["nome"] ?></td>
                                        <td><?= $reg["unidade_medida"] ?></td>
                                        <td><?= $reg["preco"] ?></td>
                                        <td><?= $reg["quant_vendida"] ?></td>
                                        <td><?= $reg["total"] ?></td>
                                    </tr>
                        <?php }} ?>
                    </table>   
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Deletar" class="btn btn-danger">
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