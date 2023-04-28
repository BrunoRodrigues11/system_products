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
    <title>Categorias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
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
                <a class="btn btn-success" type="button" href="cad_cat.php">Adicionar</a>
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>                        
                            <th>Descrição</th>
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
                            <td><a class="btn btn-warning" href="edit_enfer.php?id=<?= $reg['id']?>">Editar</a></td>
                            <td><a class="btn btn-danger" href="del_enfer.php?id=<?= $reg['id']?>">Excluir</a></td>
                        </tr>                    
                    </tbody>    
                    <?php                      
                        };
                    ?>
                </table>    
            </form>

        </div>
    </div>
    <script
  src="https://code.jquery.com/jquery-3.6.4.min.js"
  integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
  crossorigin="anonymous"></script>
  <script>
    // obtém o elemento do alerta
    var alerta = document.getElementById('.#lert');

    // esconde o alerta após 500ms
    setTimeout(function() {
    alerta.style.display = 'none';
    }, 500);
  </script>
</body>
</html>