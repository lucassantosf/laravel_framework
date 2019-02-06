<nav class="navbar navbar-expand-lg navbar-dark bg-primary rounded">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbar">
    <ul class="navbar-nav mr-auto">
      <li @if($current=="home") class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
      </li>

      <li @if($current=="produtos") class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/produtos">Produtos<span class="sr-only">(current)</span></a>
      </li>

      <li @if($current=="compras") class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/compras">Compras<span class="sr-only">(current)</span></a>
      </li>

      <li @if($current=="vendas") class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/vendas">Vendas<span class="sr-only">(current)</span></a>
      </li>

      <li @if($current=="relatorios") class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/relatorios">Relatórios<span class="sr-only">(current)</span></a>
      </li>
    
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>

  </div>
</nav>