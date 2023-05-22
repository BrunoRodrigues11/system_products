<?php 
    include('../../connection/connection.php');
    if (session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendedores</title>
    <link href="../../node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../node_modules/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="../../css/style.css" rel="stylesheet">  
</head>

<body>
    <?php
        include("../../components/navbar.php");
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
    ?>

    <div class="container">
        <div class="row pt-3">
            <div class="form-control">
                <div class="row d-flex justify-content-between align-items-start">
                    <div class="col-md-6">            
                        <h3>
                            Vendedores
                        </h3>                
                    </div> 
                    <div class="col-md-3 btn-add">
                        <a class="btn btn-success" type="button" href="./cadastro.php">
                            <i class="bi bi-plus"></i>
                            Adicionar
                        </a>
                    </div>                                 
                </div>
                <form action="" method="post">
                    <table class="table table-responsive table-hover text-bg-light align-middle">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Cidade</th>
                                <th colspan='2'>Ações</th>
                            </tr>
                        </thead>
                        <?php
                            $sql = "SELECT * FROM vendedor ORDER BY cod";
                            $resu = mysqli_query($conn,$sql) or die(mysqli_connect_error());
                            while ($reg = mysqli_fetch_array($resu)){
                        ?>
                        <tbody>
                            <tr>
                                <td><?= $reg["cod"] ?></td>
                                <td><?= $reg["nome"] ?></td>
                                <td><?= $reg["cidade"] ?></td>
                                <td><a class="btn btn-warning" href="./editar.php?cod=<?= $reg['cod']?>">Editar</a></td>
                                <td><a class="btn btn-danger" href="./excluir.php?cod=<?= $reg['cod']?>">Excluir</a></td>
                            </tr>
                        </tbody>
                        <?php                      
                            };
                        ?>
                    </table>
                </form>
            </div>

        </div>
    </div>
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/utils/notificação.js"></script>
</body>

</html>