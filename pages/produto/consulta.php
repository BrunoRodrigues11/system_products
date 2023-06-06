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
    <title>Consultar Produtos</title>
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
                            Consultar Produtos
                        </h3>                
                    </div>                               
                </div>
                <div class="row d-flex justify-content-center p-5">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="bi bi-search"></i>
                            </span>
                            <input id="inputText" type="text" class="form-control" placeholder="Pesquisar" aria-label="Username" aria-describedby="basic-addon1">
                            <button id="buttonSearch" class="btn btn-primary" type="button" aria-expanded="false">
                                Pesquisar
                            </button>
                        </div>  
                    </div>
                </div>  
                <table id="resultTable" style="display:none"  class="table table-responsive table-hover text-bg-light align-middle">
                    <thead><tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Estoque Atual</th>
                        <th>Estoque Min</th>
                        <th>Unid.</th>
                        <th>Categoria</th>
                    </tr></thead>
                    <tbody></tbody>
                </table>                           
            </div>
        </div>
    </div>
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/utils/notificação.js"></script>
    <script> 
        $(document).ready(() => {
            $("#buttonSearch").click(() => {
                var inputValue = $("#inputText").val();

                $.ajax({
                    url: "./php/consulta.php",
                    type: "POST",
                    data: {input: inputValue},
                    success: (res) => {
                        $("#resultTable tbody").empty();
                        $("#resultTable tbody").append(res)
                        $("#resultTable").css("display" , "table")
                    },
                    erro: (xhr, status, error) => {
                        console.log("Error Ajax: ", error)
                    }
                })
            })
        })
    </script>
</body>

</html>