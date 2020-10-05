<!DOCTYPE html>
<html>
<head>
	<title>Todo Project</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">	
</head>
<body>

<?php if (isset($_SESSION['logado'])) : ?>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="?r=home">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?r=infoUser&id=<?=$_SESSION['usuario']->id ?>">Informação do usuario</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?r=dataUser&id=<?=$_SESSION['usuario']->id ?>">Usuario</a>
          </li>
        </ul>
        <div class="form-inline mt-2 mt-md-0">
          <a class="navbar-brand" >Ola, <?=$_SESSION['usuario']->userName ?> </a>
          <a class="btn btn-outline-success my-2 my-sm-0" href="?r=logout">logout</a>
        </div>
      </div>
<?php endif; ?>
</nav>

