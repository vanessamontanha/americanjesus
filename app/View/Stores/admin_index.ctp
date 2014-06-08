<?php echo $this->Html->link('Add New Restaurant', array('action'=>'add'), array('class'=>'pull-right')); ?>
<h2>Restaurants</h2>

<table>
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('category_id'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('approved'); ?></th>
			<th><?php echo $this->Paginator->sort('rating','Avg Rating'); ?></th>
			<th style="width:120px;">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($stores) && !empty($stores)): ?>
		<?php foreach($stores as $k=>$store): ?>
		<tr>
			<td><?php echo h($store['Store']['name']); ?></td>
			<td><?php echo h($store['Category']['name']); ?></td>
			<td><?php echo h(str_replace("\n", ", ", $store['Store']['address'])); ?></td>
			<td><?php
				if($store['Store']['approved']) {
					echo $this->Form->postLink('Un-approve', array('action'=>'unapprove',$store['Store']['id']),array('confirm'=>'Are you sure?'));
				} else {
					echo $this->Form->postLink('Approve', array('action'=>'approve',$store['Store']['id']),array('confirm'=>'Are you sure?'));
				}
			?></td>
			<td><?php echo $store['Store']['rating']; ?></td>
			<td>
				<?php echo $this->Html->link('Edit', array('action'=>'edit',$store['Store']['id'])); ?>
				<?php echo $this->Form->postLink('Delete', array('action'=>'delete',$store['Store']['id']),array('confirm'=>'Are you sure?')); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		<?php else: ?>
		<tr><td colspan="6">Currently no Restaurants to display</td></tr>
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

<?php //pr($stores); ?>