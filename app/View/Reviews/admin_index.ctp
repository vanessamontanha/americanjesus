<?php echo $this->Html->link('Add New Review', array('action'=>'add'), array('class'=>'pull-right')); ?>
<h2>Reviews</h2>

<table>
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('store_id'); ?></th>
			<th><?php echo $this->Paginator->sort('review'); ?></th>
			<th><?php echo $this->Paginator->sort('stars'); ?></th>
			<th><?php echo $this->Paginator->sort('approved'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th style="width:120px;">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($reviews) && !empty($reviews)): ?>
		<?php foreach($reviews as $k=>$review): ?>
		<tr>
			<td><?php echo h($review['Store']['name']); ?></td>
			<td><a title="<?php echo h($review['Review']['review']); ?>"><?php echo h($this->Text->truncate($review['Review']['review'])); ?></a></td>
			<td><?php echo $review['Review']['stars']; ?></td>
			<td><?php
				if($review['Review']['approved']) {
					echo $this->Form->postLink('Un-approve', array('action'=>'unapprove',$review['Review']['id']),array('confirm'=>'Are you sure?'));
				} else {
					echo $this->Form->postLink('Approve', array('action'=>'approve',$review['Review']['id']),array('confirm'=>'Are you sure?'));
				}
			?></td>
			<td><?php echo $this->Time->nice($review['Review']['created']); ?></td>
			<td>
				<?php echo $this->Html->link('Edit', array('action'=>'edit',$review['Review']['id'])); ?>
				<?php echo $this->Form->postLink('Delete', array('action'=>'delete',$review['Review']['id']),array('confirm'=>'Are you sure?')); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		<?php else: ?>
		<tr><td colspan="6">Currently no Reviews to display</td></tr>
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