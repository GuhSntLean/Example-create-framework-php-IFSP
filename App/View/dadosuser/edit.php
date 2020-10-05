<div class="content">
  <div class="container clearfix">
    <div class="col-md-5 configdiv">  
      <form action="?r=updateUser&<?= $data[0]->id ?>" method=POST >
        <div class="form-label-group">
          <label for="login">Informe seu nome de usuario</label>
          <input type="text" id="login" class="form-control" name="username" value="<?= $data[0]->id ?>" >
        </div>
        <div class="form-label-group">
          <label for="inputPassword">Senha</label>
          <input type="password" id="inputPassword" class="form-control" name="pass" value="<?= $data[0]->userName ?>"> 
        </div>

        <div class="form-label-group">
          <label for="inputPassword">Repita a senha</label>
          <input type="password" id="inputPassword" class="form-control" name="repeatpass" value="<?= $data[0]->pass ?>">
        </div>
        <div class="form-label-group">
          <a class="btn btn-lg btn-primary btn-block" href='?r=home'> Voltar </a> 
          <button class="btn btn-lg btn-primary btn-block" type="submit">Atualizar</button>
        </div>
      </form>
      <div>
          <a href='?r=home'> Voltar </a> 
        </div>
    </div>
  </div>
</div>