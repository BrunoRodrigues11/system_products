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
    <title>Categorias</title>
    <link href="../../node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
    ?>

    <div class="container">
        <div class="row">
            <h1>Lista de Categorias</h1>
        </div>
        <div class="row">
            <form action="" method="post">
                <a class="btn btn-success" type="button" href="./cadastro.php">Adicionar</a>
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome</th>
                            <th colspan='2'>Ações</th>
                        </tr>
                    </thead>
                    <?php
                        $sql = "SELECT * FROM categoria ORDER BY id";
                        $resu = mysqli_query($conn,$sql) or die(mysqli_connect_error());
                        while ($reg = mysqli_fetch_array($resu)){
                    ?>
                    <tbody>
                        <tr>
                            <td><?= $reg["id"] ?></td>
                            <td><?= $reg["descricao"] ?></td>
                            <td><a class="btn btn-warning" href="./editar.php?id=<?= $reg['id']?>">Editar</a>
                            </td>
                            <td><a class="btn btn-danger" href="./excluir.php?id=<?= $reg['id']?>">Excluir</a>
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
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/utils/notificação.js"></script>
</body>

</html>