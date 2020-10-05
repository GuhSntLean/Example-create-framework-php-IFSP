
<div class="content">
<div class="container clearfix">
  <div class="col-md-5 configdiv">  
    <div >
      <div class="form-label-group">
        <label for="login">Nome do usuario</label>
        <input type="text" id="login" class="form-control" name="username" value='<?= $data->userName?>'  disabled >
      </div>
      <div>
        <a class="btn btn-warning" href='?r=editUser&id=<?= $data->id?>'> Editar </a>
        <a class="btn btn-danger" href='?r=home'> Voltar </a> 
    </div>
  </div>
</div>
</div>