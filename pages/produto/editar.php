<?php
    session_start();
    include('../../connection/connection.php');

    $cod  = filter_input(INPUT_GET,'cod',FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM produtos WHERE cod = '$cod'";
    $resultado = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($resultado);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
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
                Editar Produto
            </h1>
        </div>
        <div class="row">
            <div class="form-control">
                <form action="php/update.php" method="post">
                    <input type="hidden" name="cod" value="<?= $row['cod'] ?>" required>
                    <div class="mb-3">
                        <label for="" class="form-label">Nome:</label>
                        <input type="text" name="nome" class="form-control" maxlength="100" value="<?= $row['nome'] ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Preço:</label>
                        <input type="number" name="preco" class="form-control" maxlength="10"
                            value="<?= $row['preco'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Quantidade:</label>
                        <input type="number" name="qtd_estoque" class="form-control" maxlength="100"
                            value="<?= $row['qtd_estoque'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Unidade Medida:</label>
                        <input type="text" name="unidade_medida" class="form-control" maxlength="2"
                            value="<?= $row['unidade_medida'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <?php 
                    $queryCat = "SELECT * FROM categoria";
                    $resultadoCat = mysqli_query($conn, $queryCat);
                    if (mysqli_num_rows($resultadoCat) > 0) { ?>
                        <label for="" class="form-label">Categoria:</label>
                        <select name='id_categoria' class="form-select">
                            <?php foreach ($resultadoCat as $rowCat) { ?>
                            <option value="<?= $rowCat['id'] ?>" <?= $rowCat['id'] == $row['cod'] ? "selected" : "" ?>>
                                <?= $rowCat['descricao'] ?></option>
                            <?php } ?>
                        </select>
                        <?php } else { ?>
                        <select name='id_categoria' class="form-select" hidden required></select>
                        <label for="" class="form-label">Nenhum categoria encontrada.</label>
                        <?php } ?>
                    </div>

                    <div class="mb-3">
                        <input type="submit" value="Enviar" class="btn btn-success">
                        <input type="reset" value="Limpar" class="btn btn-primary">
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