<h2><?php echo (($this->params->action==='admin_edit') ? 'Edit' : 'Add'); ?> Allergy</h2>

<?php echo $this->Form->create('Category', array('type' => 'file')); ?>
	<?php if($this->params->action==='edit'): ?>
		<?php echo $this->Form->input('id'); ?>
	<?php endif; ?>
	<?php echo $this->Form->input('name'); ?>
	<?php echo $this->Form->input('icon',array('type'=>'file')); ?>
<?php echo $this->Form->end('Save'); ?>