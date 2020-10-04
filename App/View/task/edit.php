<?php 
  $task = $data[0];
  $opt  = $data[1];
?>
<p>Editar Tarefa</p>

<form action="?r=updateTask&id=<?=$task->id?>" method=POST>
  <p>Tarefa:    <input type="text" value="<?=$task->nameTask?>"  name="nameTask"  ></p>
	<p>Descricao: <input type="text" value="<?=$task->descricao?>" name="descricao" ></p>
  <p>Status: <select name="status">
    <?php foreach($opt as $key=> $value):?>
        <?php
          $selected = null;
          if ($task->statusTask == $value){
            $selected = 'selected';
          }
        ?>
        <option value="<?=$value?>" <?=$selected?>><?=$value?></option>
      <?php endforeach; ?>
	</select> </p>	
	<p><a class="btn btn-warning" href="?r=home">Voltar</a> <input type="submit" class="btn btn-success" value="Salvar"></p>
</form>
