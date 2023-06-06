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
    <title>Consultar Clientes</title>
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
                <div class="row d-flex justify-content-center pt-3">
                    <div class="col-md-6">            
                        <h3 class="text-center">
                            Consultar Clientes
                        </h3>                
                    </div>                               
                </div>
                <div class="row d-flex justify-content-center p-5">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Pesquisar" aria-label="Username" aria-describedby="basic-addon1">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Filtro
                                </button>
                                <ul class="dropdown-menu">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Nome
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                    <label class="form-check-label" for="exampleRadios2">
                                        CPF
                                    </label>
                                </div>
                                </ul>
                            </div>
                        </div>  
                    </div>
                </div>                           
            </div>
        </div>
    </div>
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/utils/notificação.js"></script>
</body>

</html>