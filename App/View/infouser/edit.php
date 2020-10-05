<div class="content">
  <div class="container clearfix">
    <div class="col-md-5 configdiv">  
      <form action="?r=saveInfo&id=<?=$data[0]->idDatauser?>" method=POST >
        <div class="form-label-group">
          <label for="login">Primeiro nome</label>
          <input type="text" id="login" class="form-control" name="firstName"  value="<?= $data[0]->first_names ?>" >
        </div>

        <div class="form-label-group">
          <label for="login">Sobrenome</label>
          <input type="text" id="login" class="form-control" name="lastName"  value="<?= $data[0]->last_name ?>" >
        </div>

        <div class="form-label-group">
          <label for="login">E-mail</label>
          <input type="email" id="login" class="form-control" name="email"  value="<?= $data[0]->email ?>" >
        </div>

        <div class="form-label-group">
          <button class="btn btn-lg btn-primary btn-block" type="submit">Editar</button>
          <a class="btn btn-lg btn-primary btn-block" href='?r=home'> Voltar </a> 
        </div>
      </form>
      <div>
          <a href='?r=home'> Voltar </a> 
        </div>
    </div>
  </div>
</div>