<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Cliente</title>
    <link href="../../node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <button class="btn btn-outline-primary" type="button" id="btn-back">
                    <i class="bi bi-arrow-left-circle"></i>
                    Voltar
                </button>                
            </div>  
            <h1>
                Novo Cliente
            </h1>
        </div>
        <div class="row">
            <div class="form-control">
                <form action="php/insert.php" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Nome:</label>
                        <input type="text" name="nome" class="form-control" maxlength="100" required>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control" maxlength="100" required>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">CPF:</label>
                        <input type="text" name="cpf" class="form-control" mimlength="11" maxlength="11" required>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Endereco:</label>
                        <input type="text" name="endereco" class="form-control" maxlength="100" required>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Cidade:</label>
                        <input type="text" name="cidade" class="form-control" maxlength="100" required>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Estado :</label>
                        <input type="text" name="estado" class="form-control" maxlength="2" required>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Telefone:</label>
                        <input type="text" name="telefone" class="form-control" mimlength="10" maxlength="11" required>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Limite Credito:</label>
                        <input type="number" name="limite_cred" class="form-control" maxlength="10" required>
                    </div>

                    <div class=" md-3">
                        <input type="submit" value="Enviar" class="btn btn-success">
                        <input type="reset" value="Limpar" class="btn btn-primary">
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