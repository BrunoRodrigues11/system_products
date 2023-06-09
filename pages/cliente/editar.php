<?php
    include('../../connection/connection.php');
    if (session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    $codigo  = filter_input(INPUT_GET,'codigo',FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM cliente WHERE codigo = '$codigo'";
    $resultado = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($resultado);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
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
                <div class="row d-flex align-items-start">
                    <div class="col-md-2 btn-back">
                        <button class="btn btn-outline-primary" type="button" id="btn-back">
                            <i class="bi bi-arrow-left-circle"></i>
                            Voltar
                        </button>  
                    </div>
                    <div class="col-md-6">            
                        <h3>
                            Editar Cliente
                        </h3>                
                    </div>                
                </div> 
                <form action="php/update.php" method="post">
                    <input type="hidden" name="codigo" value="<?= $row['codigo'] ?>" required>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="form-label">Nome</label>
                            <input type="text" name="nome" class="form-control" maxlength="100" value="<?= $row['nome'] ?>" required>                            
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">CPF</label>
                            <input type="text" name="cpf" class="form-control" mimlength="11" maxlength="11" value="<?= $row['cpf'] ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Email:</label>
                            <input type="email" name="email" class="form-control" maxlength="100"
                                value="<?= $row['email'] ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Enderço:</label>
                            <input type="text" name="endereco" class="form-control" maxlength="100"
                                value="<?= $row['endereco'] ?>" required>
                        </div>                        
                    </div>
                    <div class="row">
                       <div class="col-md-6">
                            <label for="" class="form-label">Cidade</label>
                            <input type="text" name="cidade" class="form-control" maxlength="100" value="<?= $row['cidade'] ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Estado</label>
                            <input class="form-control" list="datalistOptions" id="estado" name="estado" placeholder="Selecione o estado" value="<?= $row['estado'] ?>" required>
                            <datalist id="datalistOptions">
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espirito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraiba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                            </datalist>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Telefone:</label>
                            <input type="text" name="telefone" class="form-control" minlength="10" maxlength="11"
                                value="<?= $row['telefone'] ?>" required>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Limite Credito:</label>
                            <input type="number" name="limite_cred" class="form-control" maxlength="10"
                                value="<?= $row['limite_cred'] ?>" required>
                        </div>                        
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Salvar" class="btn btn-success">
                            <input type="reset" value="Limpar" class="btn btn-danger">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/main.js"></script>
</body>

</html>