<?php
    include('../../connection/connection.php');
    if (session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

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
                            Editar Produto
                        </h3>                
                    </div>                
                </div> 
                <form action="php/update.php" method="post">
                    <input type="hidden" name="cod" value="<?= $row['cod'] ?>" required>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Nome:</label>
                            <input type="text" name="nome" class="form-control" maxlength="100" value="<?= $row['nome'] ?>"
                                required>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Preço:</label>
                            <input type="number" name="preco" class="form-control" maxlength="10"
                                value="<?= $row['preco'] ?>" required>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Quantidade:</label>
                            <input type="number" name="qtd_estoque" class="form-control" maxlength="100"
                                value="<?= $row['qtd_estoque'] ?>" required>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Unidade Medida:</label>
                            <input type="text" name="unidade_medida" class="form-control" maxlength="2"
                                value="<?= $row['unidade_medida'] ?>" required>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col">
                            <?php 
                                $queryCat = "SELECT * FROM categoria";
                                $resultadoCat = mysqli_query($conn, $queryCat);
                                if (mysqli_num_rows($resultadoCat) > 0) { ?>
                                    <label for="" class="form-label">Categoria:</label>
                                    <select name='id_categoria' class="form-select">
                                        <?php foreach ($resultadoCat as $rowCat) { ?>
                                        <option value="<?= $rowCat['id'] ?>" <?= $rowCat['id'] == $row['cod'] ? "selected" : "" ?>>
                                            <?= $rowCat['descricao'] ?>
                                        </option>
                            <?php } ?>
                                    </select>
                            <?php } else { ?>
                                    <select name='id_categoria' class="form-select" hidden required></select>
                                    <label for="" class="form-label">Nenhum categoria encontrada.</label>
                            <?php } ?>
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