<?php
    session_start();
    include('../../connection/connection.php');

    $cod = filter_input(INPUT_GET,'cod',FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT p.*, c.descricao AS nome_categoria FROM produtos p INNER JOIN categoria c ON p.id_categoria = c.id  WHERE p.cod = '$cod'";
    $resultado = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($resultado);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Produto</title>
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
                Deletar Produto
            </h1>
        </div>
        <div class="row">
            <div class="form-control">
                <form action="php/delete.php" method="post">
                    <input type="hidden" name="cod" value="<?= $row['cod'] ?>" required>
                    <div class="mb-3">
                        <label for="" class="form-label"><b>Codigo:</b> <?= $row['cod'] ?></label>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"><b>Nome:</b> <?= $row['nome'] ?></label>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"><b>Preo:</b> <?= $row['preco'] ?></label>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"><b>Quantidade:</b> <?= $row['qtd_estoque'] ?></label>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"><b>Unidade Medida:</b> <?= $row['unidade_medida'] ?></label>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"><b>Categoria:</b> <?= $row['nome_categoria'] ?></label>
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