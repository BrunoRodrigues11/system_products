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
                            Consultar Pedidos
                        </h3>                
                    </div>                               
                </div>
                <div class="row d-flex justify-content-center p-5">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                    <i class="bi bi-search"></i>
                                </span>
                            <input id="inputText" type="number" class="form-control" placeholder="Pesquisar" aria-label="Username" aria-describedby="basic-addon1">
                            <button id="buttonSearch" class="btn btn-primary" type="button" aria-expanded="false">
                                Pesquisar
                            </button>
                        </div>  
                    </div>
                </div>  
                <table id="resultTable" style="display:none"  class="table table-responsive table-hover text-bg-light align-middle">
                    <thead><tr>
                        <th></th>                        
                        <th>Número</th>
                        <th>Data</th>
                        <th>Prazo entrega</th>
                        <th>Cond. Pagto</th>   
                        <th>Cod. Cliente</th>                     
                        <th>Cliente</th>
                        <th>Cod. Vendedor</th>
                        <th>Vendedor</th>
                    </tr></thead>
                    <tbody>
                    </tbody>
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
                var inputValueN= $("#inputText").val();

                $.ajax({
                    url: "./php/consultaP.php",
                    type: "POST",
                    data: {input: inputValueN},
                    success: (res) => {
                        $("#resultTable tbody").empty();
                        $("#resultTable tbody").append(res)
                        $("#resultTable").css("display" , "table")
                        carregar()
                    },
                    erro: (xhr, status, error) => {
                        console.log("Error Ajax: ", error)
                    }
                })
            })
        })

        function carregar(){
            var linhasExpansiveis = document.querySelectorAll(".linha-expansivel");

            linhasExpansiveis.forEach(function(linha) {                        
                linha.addEventListener('click', () => {
                    var target = linha.getAttribute("data-target");   
                    var conteudoExtra = document.querySelector("." + target); 

                    if (conteudoExtra.style.display === "table-row") {
                        conteudoExtra.style.display = "none";                    
                    } else {
                        conteudoExtra.style.display = "table-row";                          
                    }                
                })
            });
        
        }
        //Função para remover um produto 
        function expandRow(numV) {
            $.ajax({
                url: "./php/consultaIV.php",
                method: "POST",
                data: { numV: numV },
                success: (res) => {
                    $("#resultTable1 tbody").empty();
                    $("#resultTable1 tbody").append(res)                    
                    if( $("#resultTable1").css("display") == "none"){
                        $("#resultTable1").css("display" , "table")  
                        $("#buttonExpand").removeClass("bi bi-plus");
                        $("#buttonExpand").addClass("bi bi-dash");                                            
                    }else{
                        $("#resultTable1").css("display" , "none")   
                        $("#buttonExpand").removeClass("bi bi-dash");
                        $("#buttonExpand").addClass("bi bi-plus");    
                    }
                },
                erro: (xhr, status, error) => {
                    console.log("Error Ajax: ", error)
                }
            });
        }
    </script>
</body>

</html>