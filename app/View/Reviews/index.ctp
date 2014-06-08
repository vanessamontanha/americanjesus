




<div class="row">
		<?php if(isset($store['Review']) && !empty($store['Review'])): ?>
		<?php foreach($store['Review'] as $k=>$review): ?>
		
                    <p><strong>Review: </strong><?php echo h($review['review']); ?></p>
                    <p><strong>Stars: </strong><span class="stars star_<?php echo $review['stars']; ?>"></span></p>
                    <p><strong>Date: </strong> <?php echo $this->Time->nice($review['created']); ?></p>
                    <hr>
		<?php endforeach; ?>
		<?php else: ?>
		
			<td colspan="3">No Reviews to display, <?php echo $this->Html->link('add the first', array('action'=>'add',$store['Store']['id'])); ?></td>
		
		<?php endif; ?>
                        
                        <div class="related">
<?php echo $this->Html->link('Add Review', array('action'=>'add',$store['Store']['id']), array('class'=>'pull-right')); ?>

</div>

</div>
</div>