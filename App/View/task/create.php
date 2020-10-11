<p>Nova Tarefa</p>
<?php
  $opt = $data[1];
  $id  = $data[0]; 
?>
<form action="?r=saveTask&id=<?=$id?>" method=POST>
  <p>Tarefa:    <input type="text" value="<?=$task->nameTask?>"  name="nameTask"  ></p>
	<p>Descricao: <input type="text" value="<?=$task->descricao?>" name="descricao" ></p>
  <p>Status: <select name="status">
      <?php foreach($opt as $key=> $value):?>
        <option value="<?=$value?>" <?=$selected?>><?=$value?></option>
      <?php endforeach; ?>
	</select> </p>	
	<p><a class="btn btn-warning" href="?r=home">Voltar</a> <input type="submit" class="btn btn-success" value="Salvar"></p>
</form>