<?php
    session_start();
    include('../../connection/connection.php');

    $id  = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM categoria WHERE id = '$id'";
    $resultado = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($resultado);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoria</title>
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
                Editar Categoria
            </h1>
        </div>
        <div class="row">
            <div class="form-control">
                <form action="php/update.php" method="post">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>" required>
                    <div class="mb-3">
                        <label for="" class="form-label">Nome:</label>
                        <input type="text" name="descricao" class="form-control" maxlength="100"
                            value="<?= $row['descricao'] ?>" required>
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
    <script src="../../js/main.js"></script>
</body>

</html>