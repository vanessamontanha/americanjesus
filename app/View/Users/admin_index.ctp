<h2>Users</h2>

<table>
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('admin'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th style="width:120px;">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($users) && !empty($users)): ?>
		<?php foreach($users as $k=>$user): ?>
		<tr>
			<td><?php echo $user['User']['email']; ?></td>
			<td><?php echo ($user['User']['admin']) ? 'Yes' : 'No'; ?></td>
			<td><?php echo $this->Time->nice($user['User']['created']); ?></td>
			<td>
				<?php echo $this->Html->link('View', array('action'=>'view',$user['User']['id'])); ?>
				<?php echo $this->Form->postLink('Delete', array('action'=>'delete',$user['User']['id']),array('confirm'=>'Are you sure?')); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		<?php else: ?>
		<tr><td colspan="2">Currently no Users to display</td></tr>
		<?php endif; ?>
	</tbody>
</table>

<div class="paging">
<?php
	echo $this->Paginator->prev('< ' . __d('cake', 'previous'), array(), null, array('class' => 'prev disabled'));
	echo $this->Paginator->numbers(array('separator' => ''));
	echo $this->Paginator->next(__d('cake', 'next') .' >', array(), null, array('class' => 'next disabled'));
?>
</div>