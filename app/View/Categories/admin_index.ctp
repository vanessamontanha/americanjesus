<?php echo $this->Html->link('Add New Category', array('action'=>'add'), array('class'=>'pull-right')); ?>
<h2>Categories</h2>

<table>
	<thead>
		<tr>
			<th style="width:40px;">&nbsp;</th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('num_stores','# Stores'); ?></th>
			<th style="width:120px;">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($categories) && !empty($categories)): ?>
		<?php foreach($categories as $k=>$category): ?>
		<tr>
			<td><?php echo $this->Html->image('icons/'.$category['Category']['icon']); ?></td>
			<td><?php echo h($category['Category']['name']); ?></td>
			<td><?php echo $category['Category']['num_stores']; ?></td>
			<td>
				<?php echo $this->Html->link('Edit', array('action'=>'edit',$category['Category']['id'])); ?>
				<?php echo $this->Form->postLink('Delete', array('action'=>'delete',$category['Category']['id']),array('confirm'=>'Are you sure?')); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		<?php else: ?>
		<tr><td colspan="2">Currently no Categories to display</td></tr>
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