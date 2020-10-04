<div class="content">
  <div class="container clearfix">
    <div class="col-md-5 configdiv">  
      <form action="?r=createuser" method=POST >
        <div class="form-label-group">
          <label for="login">Informe seu nome de usuario</label>
          <input type="text" id="login" class="form-control" name="username" placeholder="Nome de usuario">
        </div>
        <div class="form-label-group">
          <label for="inputPassword">Senha</label>
          <input type="password" id="inputPassword" class="form-control" name="pass" placeholder="Senha">
        </div>

        <div class="form-label-group">
          <label for="inputPassword">Repita a senha</label>
          <input type="password" id="inputPassword" class="form-control" name="repeatpass" placeholder="Repita a senha">
        </div>
        <div class="form-label-group">
          <button class="btn btn-lg btn-primary btn-block" type="submit">Cadastrar</button>
        </div>
      </form>
      <div>
          <a href='?r=home'> Voltar </a> 
        </div>
    </div>
  </div>
</div>