<h2><?php echo (($this->params->action==='admin_edit') ? 'Edit' : 'Add'); ?> Store</h2>

<?php echo $this->Form->create('Store'); ?>
	<?php
	if($this->params->action==='edit') {
		echo $this->Form->input('id');
	}
	echo $this->Form->input('category_id');
	echo $this->Form->input('name');
	?>

	<div id="address_wrapper">
		<?php echo $this->Form->input('address',array(
			'after' => '<small>The address will be looked up after moving onto the next field</small>'
		)); ?>
		<div id="map_canvas"></div>
	</div>

	<?php
	echo $this->Form->input('lat',array('type'=>'hidden'));
	echo $this->Form->input('lng',array('type'=>'hidden'));
	echo $this->Form->input('telephone_number');
	echo $this->Form->input('email_address');
	echo $this->Form->input('url');
	echo $this->Form->input('description');
        echo $this->Form->input('cuisine');
	?>
<?php echo $this->Form->end('Save'); ?>