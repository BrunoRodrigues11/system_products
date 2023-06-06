<?php
    include('../../connection/connection.php');
    if (session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Produto</title>
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
                            Novo Produto
                        </h3>                
                    </div>                
                </div> 
                <form action="php/insert.php" method="post">
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Nome</label>
                            <input type="text" name="nome" class="form-control" maxlength="100" required>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Preço</label>
                            <input type="number" name="preco" class="form-control" maxlength="10" required>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Estoque Atual</label>
                            <input type="number" name="estoque_atual" class="form-control" maxlength="100" required>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Estoque Mínimo</label>
                            <input type="number" name="estoque_min" class="form-control" maxlength="100" required>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Unidade Medida</label>
                            <input type="text" name="unidade_medida" class="form-control" maxlength="2" required>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col">
                            <?php 
                                $queryCat = "SELECT * FROM categoria";
                                $resultadoCat = mysqli_query($conn, $queryCat);
                                if (mysqli_num_rows($resultadoCat) > 0) { ?>
                                    <label for="" class="form-label">Categoria</label>
                                    <select name='id_categoria' class="form-select">
                                        <?php foreach ($resultadoCat as $rowCat) { ?>
                                        <option value="<?= $rowCat['id'] ?>"> <?= $rowCat['descricao'] ?></option>
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
                            <input type="submit" value="Enviar" class="btn btn-success">
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