<h2><?php echo (($this->params->action==='admin_edit') ? 'Edit' : 'Add'); ?> Review</h2>

<?php echo $this->Form->create('Review'); ?>
	<?php
	if($this->params->action==='edit') {
		echo $this->Form->input('id');
	}
	?>
	<?php echo $this->Form->input('store_id'); ?>
	<?php echo $this->Form->input('review'); ?>
	<?php echo $this->Form->input('stars'); ?>
<?php echo $this->Form->end('Save'); ?>