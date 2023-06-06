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
    <title>Editar Vendedor</title>
    <link href="../../node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../node_modules/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="../../css/style.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../../components/assets/favicon.ico">
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
                            Editar Vendedor
                        </h3>                
                    </div>                
                </div> 
                <form action="php/update.php" method="post">
                    <input type="hidden" name="cod" value="<?= $row['cod'] ?>" required>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Nome</label>
                            <input type="text" name="nome" class="form-control" maxlength="100" value="<?= $row['nome'] ?>"
                                required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Endereço</label>
                            <input type="text" name="endereco" class="form-control" maxlength="100"
                                value="<?= $row['endereco'] ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Cidade</label>
                            <input type="text" name="cidade" class="form-control" maxlength="100"
                                value="<?= $row['cidade'] ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Estado</label>
                            <input type="text" name="estado" class="form-control" maxlength="2"
                                value="<?= $row['estado'] ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Telefone</label>
                            <input type="text" name="telefone" class="form-control" maxlength="100"
                                value="<?= $row['telefone'] ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Comissão</label>
                            <input type="number" name="parc_comissao" class="form-control" min="0" max="100"
                                value="<?= $row['parc_comissao'] ?>" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Salvar" class="btn btn-success">
                            <input type="reset" value="Limpar" class="btn btn-danger">
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