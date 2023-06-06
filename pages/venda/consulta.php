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
    <title>Consultar Vendas</title>
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
                            Consultar Vendas
                        </h3>                
                    </div>                               
                </div>
                <div class="row d-flex justify-content-center p-5">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input id="inputData1" type="date" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                            <span class="align-middle ps-2 pe-2">até</span>
                            <input id="inputData2" type="date" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                            <button id="buttonSearch" class="btn btn-primary" type="button" aria-expanded="false">
                                Pesquisar
                            </button>
                        </div>  
                    </div>
                </div>  
                <table id="resultTable" style="display:none"  class="table table-responsive table-hover text-bg-light align-middle">
                    <thead><tr>
                        <th>Número</th>
                        <th>Data</th>
                        <th>Prazo entrega</th>
                        <th>Cond. Pagto</th>   
                        <th>Cod. Cliente</th>                     
                        <th>Cliente</th>
                        <th>Cod. Vendedor</th>
                        <th>Vendedor</th>
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
                var inputData1 = $("#inputData1").val();
                var inputData2 = $("#inputData2").val();

                $.ajax({
                    url: "./php/consulta.php",
                    type: "POST",
                    data: {input1: inputData1, input2: inputData2},
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