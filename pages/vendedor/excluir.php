<?php
    include('../../connection/connection.php');
    if (session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    $cod = filter_input(INPUT_GET,'cod',FILTER_SANITIZE_NUMBER_INT);
    $result = "SELECT * FROM vendedor WHERE cod = '$cod'";
    $resultado = mysqli_query($conn, $result);
    $row = mysqli_fetch_assoc($resultado);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Vendedor</title>
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
                            Deletar Cliente
                        </h3>                
                    </div>                
                </div>  
                <form action="php/delete.php" method="post">
                    <input type="hidden" name="cod" value="<?= $row['cod'] ?>" required>
                    <div class="mb-3">
                        <label for="" class="form-label"><b>Codigo:</b> <?= $row['cod'] ?></label>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"><b>Nome:</b> <?= $row['nome'] ?></label>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"><b>Endereço:</b> <?= $row['endereco'] ?></label>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"><b>Cidade:</b> <?= $row['cidade'] ?></label>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"><b>Estado:</b> <?= $row['estado'] ?></label>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"><b>Telefone:</b> <?= $row['telefone'] ?></label>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"><b>Comissão:</b> <?= $row['parc_comissao'] ?></label>
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
    <script src="../../js/main.js"></script>
</body>

</html>