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
    <title>Produtos</title>
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
            <h1>Lista de Produtos</h1>
        </div>
        <div class="row">
            <form action="" method="post">
                <a class="btn btn-success" type="button" href="./cadastro.php">Adicionar</a>
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Unidade Medidade</th>
                            <th>Categoria</th>
                            <th colspan='2'>Ações</th>
                        </tr>
                    </thead>
                    <?php
                        $sql = "SELECT p.*, c.descricao AS nome_categoria FROM produtos p INNER JOIN categoria c ON p.id_categoria = c.id ORDER BY cod";
                        $resu = mysqli_query($conn,$sql) or die(mysqli_connect_error());
                        while ($reg = mysqli_fetch_array($resu)){
                    ?>
                    <tbody>
                        <tr>
                            <td><?= $reg["cod"] ?></td>
                            <td><?= $reg["nome"] ?></td>
                            <td><?= $reg["preco"] ?></td>
                            <td><?= $reg["qtd_estoque"] ?></td>
                            <td><?= $reg["unidade_medida"] ?></td>
                            <td><?= $reg["nome_categoria"] ?></td>
                            <td><a class="btn btn-warning" href="./editar.php?cod=<?= $reg['cod']?>">Editar</a>
                            </td>
                            <td><a class="btn btn-danger" href="./excluir.php?cod=<?= $reg['cod']?>">Excluir</a>
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