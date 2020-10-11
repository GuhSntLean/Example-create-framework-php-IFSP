<?php
  $tasks = $data[0];
  $user = $data[1];
?>
<div class="form-signin">
<div class="page-header">
	<h4>Lista de Tarefas</h4>
</div>

<table class="table">
	<tr>
		<th>Tarefa</th>
		<th>Status</th>
		<th>Ações</th>
	</tr>
  <?php foreach ($tasks as $task): ?>
    <tr>
      <td><?= $task->nameTask ?></td>
      <td><?= $task->statusTask ?></td>
      <td>
          <a href="?r=editTask&id=<?= $task->id ?>"   class="btn btn-warning">Editar</a>
          <a href="?r=deleteTask&id=<?= $task->id ?>" class="btn btn-danger">Deletar</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<a href="?r=newTask&id=<?= $user->id ?>" class="btn btn-success">Nova tarefa</a>
</div>

