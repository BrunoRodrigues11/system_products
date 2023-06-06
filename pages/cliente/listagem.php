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
    <title>Clientes</title>
    <link href="../../node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../node_modules/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="../../css/style.css" rel="stylesheet">  
    <link rel="icon" type="image/x-icon" href="../../components/assets/favicon.ico">
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
                            Clientes
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
                    <div class="row">
                    </div>
                    <table class="table table-responsive table-hover text-bg-light align-middle">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>Email</th>
                                <th colspan='2'>Ações</th>
                            </tr>
                        </thead>
                        <?php
                            $sql = "SELECT * FROM cliente WHERE nome LIKE '%%' ORDER BY codigo";
                            $resu = mysqli_query($conn,$sql) or die(mysqli_connect_error());
                            while ($reg = mysqli_fetch_array($resu)){
                        ?>
                        <tbody>
                            <tr>
                                <td><?= $reg["codigo"] ?></td>
                                <td><?= $reg["nome"] ?></td>
                                <td><?= $reg["telefone"] ?></td>
                                <td><?= $reg["email"] ?></td>
                                <td>
                                    <a class="btn btn-primary" href="./editar.php?codigo=<?= $reg['codigo']?>">
                                        <i class="bi bi-pencil-fill text-white"></i>
                                    </a>
                                    <a class="btn btn-danger" href="./excluir.php?codigo=<?= $reg['codigo']?>">
                                        <i class="bi bi-trash3-fill"></i>
                                    </a>
                                </td>
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