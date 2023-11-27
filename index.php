<?php
include("connection/connection.php");
session_start();
if (isset($_SESSION['cpf'])) {
} else {
  header("Location: admin/auth/login.php");
}

// Retorna a quantidade de produtos cadastrados
$queryQtdeProd = "SELECT * FROM cont_prod";
$resultadoQtdeProd = mysqli_query($conn, $queryQtdeProd);
$rowQtdeProd = mysqli_fetch_array($resultadoQtdeProd);

// Retorna a quantidade de produtos com estoque zerado
$queryQtdeEstoqueZ = "SELECT * FROM qtde_estoque_zero";
$resultadoQtdeEstoqueZ = mysqli_query($conn, $queryQtdeEstoqueZ);
$rowQtdeEstoqueZ = mysqli_fetch_array($resultadoQtdeEstoqueZ);

// Retorna a quantidade de produtos com estoque minimo
$queryQtdeEstoqueM = "SELECT * FROM qtde_estoque_min";
$resultadoQtdeEstoqueM = mysqli_query($conn, $queryQtdeEstoqueM);
$rowQtdeEstoqueM = mysqli_fetch_array($resultadoQtdeEstoqueM);

// Retorna a quantidade de estoque total 
$queryQtdeEstoqueT = "SELECT * FROM qtde_estoque_total";
$resultadoQtdeEstoqueT = mysqli_query($conn, $queryQtdeEstoqueT);
$rowQtdeEstoqueT = mysqli_fetch_array($resultadoQtdeEstoqueT);

// Retorna a quantidade de produtos por categoria 
$queryQtdeProdCat = "SELECT * FROM cont_prod_cat";
$resultadoQtdeProdCat = mysqli_query($conn, $queryQtdeProdCat);

// chart.js - Preparando valores
$categoria = '';
$qtde_prod = '';

while ($rowQtdeProdCat = mysqli_fetch_array($resultadoQtdeProdCat)) {
  $categoria = $categoria . '"' . $rowQtdeProdCat['categoria'] . '",';
  $qtde_prod = $qtde_prod . '"' . $rowQtdeProdCat['qtde_prod'] . '",';

  $categoria = trim($categoria);
  $qtde_prod = trim($qtde_prod);
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link href="node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="node_modules/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="./components/assets/favicon.ico">
</head>

<body>
  <?php include('components/navbar_index.php') ?>
  <div class="container pt-3">
    <h1>Olá,
      <?php echo $_SESSION['nome'] ?>
    </h1>
    <div class="row">
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                  Produtos Cadastrados
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <?= $rowQtdeProd['qtde_prod'] ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                  Produtos com estoque zerado
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <?= $rowQtdeEstoqueZ['qtde'] ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                  Produtos com estoque mínimo
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <?= $rowQtdeEstoqueM['qtde'] ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  Quantidade em estoque
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <?= $rowQtdeEstoqueT['qtde'] ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Últimas vendas</h6>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <table class="table table-responsive table-hover text-bg-light align-middle">
                <thead>
                  <tr>
                    <th>Número</th>
                    <th>Data</th>
                    <th>Cond. Pagto</th>
                    <th>Cliente</th>
                    <th>Vendedor</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <?php
                $sql = "SELECT v.*, c.nome AS Cliente, vd.nome AS Vendedor FROM vendas v INNER JOIN cliente c ON v.cod_cliente = c.codigo INNER JOIN vendedor vd ON v.cod_vendedor = vd.cod ORDER BY numero DESC LIMIT 7";
                $resu = mysqli_query($conn, $sql) or die(mysqli_connect_error());
                while ($reg = mysqli_fetch_array($resu)) {
                  ?>
                  <tbody>
                    <tr>
                      <td>
                        <?= $reg["numero"] ?>
                      </td>
                      <td>
                        <?= date('d/m/Y', strtotime($reg["data"])) ?>
                      </td>
                      <td>
                        <?= $reg["cond_pagto"] ?>
                      </td>
                      <td>
                        <?= $reg["Cliente"] ?>
                      </td>
                      <td>
                        <?= $reg["Vendedor"] ?>
                      </td>
                      <td>R$
                        <?= $reg["total"] ?>
                      </td>
                    </tr>
                  </tbody>
                  <?php
                }
                ;
                ?>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- Donut Chart -->
      <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Produtos por Categoria</h6>
          </div>
          <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
              <canvas id="myPieChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="node_modules/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="node_modules/chart.js/dist/chart.umd.js"></script>
  <script src="js/main.js"></script>

  <!-- Gráfico de rosca -->
  <script>
    // Pie Chart Example
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: [<?php echo $categoria; ?>],
        datasets: [{
          data: [<?php echo $qtde_prod; ?>],
          // backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
          // hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
          // hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false
        },
        cutoutPercentage: 80,
      },
    });
  </script>

</body>

</html>