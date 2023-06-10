<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
</head>
<body>
  <nav class="navbar navbar-expand-lg text-bg-dark ">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <img src="./components/assets/logo2.png" alt="" class="img-logo">  
      </a>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link text-bg-dark" href="index.php">Home</a></li>
          <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Cadastros
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="pages/categoria/cadastro.php">Categorias</a></li>
              <li><a class="dropdown-item" href="pages/vendedor/cadastro.php">Vendedores</a></li>
              <li><a class="dropdown-item" href="pages/cliente/cadastro.php">Clientes</a></li>
              <li><a class="dropdown-item" href="pages/venda/cadastro.php">Vendas</a></li>
              <li><a class="dropdown-item" href="pages/produto/cadastro.php">Produtos</a></li>
            </ul>
          </div>
          <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"> 
              Consultas
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="pages/vendedor/consulta.php">Vendedores</a></li>
              <li><a class="dropdown-item" href="pages/cliente/consulta.php">Clientes</a></li>
              <li><a class="dropdown-item" href="pages/venda/consulta.php">Vendas</a></li>
              <li><a class="dropdown-item" href="pages/venda/consultaP.php">Pedidos</a></li>
              <li><a class="dropdown-item" href="pages/produto/consulta.php">Produtos</a></li>
            </ul>
          </div>
          <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Relatórios
            </button>
              <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="pages/venda/relatorio">Pedidos</a></li>
              <li><a class="dropdown-item" href="pages/produto/relatorio.php">Produtos</a></li>
            </ul>
          </div>
        </ul>        
      </div>
    </div>
  </nav>
</body>
</html>