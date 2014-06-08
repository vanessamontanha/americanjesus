<a href="#" data-toggle="tooltip" title="Enter text only. No special characters allowed eg. I love it"><label for="inputPassword3" class="col-sm-2 control-label">Submit Review</label></a>

<?php echo $this->Form->create('Review'); ?>
	
<?php echo $this->Form->input('store_id',array('type'=>'hidden')); ?>

<div class="form-group">
            
            <div class="col-sm-10">
                <?php echo $this->Form->textarea('review',array('class'=>'form-control','rows'=>3));?>
            </div>
	
<div class="input select required">
	<label>Stars</label>
	<?php
	$star_class = 'one-star';
	if($this->request->data['Review']['stars']==2) {
		$star_class = 'two-stars';
	} elseif($this->request->data['Review']['stars']==3) {
		$star_class = 'three-stars';
	} elseif($this->request->data['Review']['stars']==4) {
		$star_class = 'four-stars';
	} elseif($this->request->data['Review']['stars']==5) {
		$star_class = 'five-stars';
	}
	?>
	<ul class='star-rating <?php echo $star_class; ?>'>
		<li class='current-rating'>Currently 3.5/5 Stars.</li>
		<li><a href='#' title='1 star out of 5' class='one-star'>1</a></li>
		<li><a href='#' title='2 stars out of 5' class='two-stars'>2</a></li>
		<li><a href='#' title='3 stars out of 5' class='three-stars'>3</a></li>
		<li><a href='#' title='4 stars out of 5' class='four-stars'>4</a></li>
		<li><a href='#' title='5 stars out of 5' class='five-stars'>5</a></li>
	</ul>
	<?php echo $this->Form->input('stars',array('div'=>FALSE,'label'=>FALSE)); ?>
</div>
<?php echo $this->Form->end('Save'); ?>