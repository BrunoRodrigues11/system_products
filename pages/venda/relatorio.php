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
    <title>Consultar Pedidos</title>
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
                            Relatorio de Pedidos
                        </h3>                
                    </div>                               
                </div>
                <form action="./php/relatorio.php" method="POST">
                    <div class="row d-flex justify-content-center p-5">
                        <div class="col-md-6">
                            <div class="input-group">
                                    <input id="data-inicial" type="date" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="data-inicial">
                                    <span class="align-middle ps-2 pe-2">até</span>
                                    <input id="data-final" type="date" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="data-final">
                                    <button id="buttonSearch" class="btn btn-primary" type="submit" aria-expanded="false">
                                        Pesquisar
                                    </button>
                            </div>  
                        </div>
                    </div>  
                </form>
            </div>
        </div>
    </div>
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/utils/notificação.js"></script>
</body>

</html>