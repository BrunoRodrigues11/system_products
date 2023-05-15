<?php
    session_start();
    include('../../connection/connection.php');

    $codigo = filter_input(INPUT_GET,'codigo',FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM cliente WHERE codigo = '$codigo'";
    $resultado = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($resultado);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Cliente</title>
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
                Deletar Cliente
            </h1>
        </div>
        <div class="row">
            <div class="form-control">
                <form action="php/delete.php" method="post">
                    <input type="hidden" name="codigo" value="<?= $row['codigo'] ?>" required>
                    <div class="mb-3">
                        <label for="" class="form-label"><b>Codigo:</b> <?= $row['codigo'] ?></label>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"><b>Nome:</b> <?= $row['nome'] ?></label>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"><b>CPF:</b> <?= $row['cpf'] ?></label>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"><b>Email:</b> <?= $row['email'] ?></label>
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
                        <label for="" class="form-label"><b>Limite de Credito:</b> <?= $row['limite_cred'] ?></label>
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