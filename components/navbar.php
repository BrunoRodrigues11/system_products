<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <nav class="navbar navbar-expand-lg text-bg-dark">
    <div class="container-fluid">
      <!-- <a class="navbar-brand" href="#"><img width="110x" src="assets/logo.png" alt=""></a> -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link text-bg-dark" href="../../index.php">Home</a></li>
          <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Cadastros
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="../../pages/categoria/cadastro.php">Categorias</a></li>
              <li><a class="dropdown-item" href="../../pages/vendedor/cadastro.php">Vendedores</a></li>
              <li><a class="dropdown-item" href="../../pages/cliente/cadastro.php">Clientes</a></li>
              <li><a class="dropdown-item" href="../../pages/venda/cadastro.php">Vendas</a></li>
              <li><a class="dropdown-item" href="../../pages/produto/cadastro.php">Produtos</a></li>
            </ul>
          </div>
          <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"> 
              Consultas
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="../../pages/categoria/listagem.php">Categorias</a></li>
              <li><a class="dropdown-item" href="../../pages/vendedor/listagem.php">Vendedores</a></li>
              <li><a class="dropdown-item" href="../../pages/cliente/listagem.php">Clientes</a></li>
              <li><a class="dropdown-item" href="../../pages/venda/listagem.php">Vendas</a></li>
              <li><a class="dropdown-item" href="../../pages/produto/listagem.php">Produtos</a></li>
            </ul>
          </div>
          <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Relatórios
            </button>
              <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="../../pages/">Pedidos</a></li>
              <li><a class="dropdown-item" href="../../pages/">Produtos</a></li>
            </ul>
          </div>
        </ul>        
      </div>
    </div>
  </nav>
</body>
</html>