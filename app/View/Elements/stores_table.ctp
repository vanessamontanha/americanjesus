<?php if(isset($stores) && !empty($stores)): ?>
<?php if($_feature_show_results_table): ?>

<hr>
<div class="row">
<ul class="list-group">
    <?php foreach($stores as $k=>$v): ?>
    <li class="list-group-item"><strong>Name:</strong> <?php
				if($v['Store']['url']) {
					echo '<a href="'.$v['Store']['url'].'" target="_blank">'.h($v['Store']['name']).'</a>';
				} else {
					echo h($v['Store']['name']);
				}
			?></li>
   <li class="list-group-item"><strong>Address:</strong> <?php echo h(str_replace("\n", ", ", $v['Store']['address'])); ?> </li>
   <li class="list-group-item"><strong>Telephone:</strong> <?php echo ($v['Store']['telephone_number']) ? $v['Store']['telephone_number'] : 'n/a'; ?> </li>
   <li class="list-group-item"><strong>Stars:</strong><span class="stars star_<?php echo $v['Store']['rating']; ?>"></span></li>
   <li class="list-group-item"><strong>Distance:</strong><?php echo (isset($v[0]['distance'])) ? round($v[0]['distance'],2).' '.$_search_distance : 'n/a'; ?> </li>
   <li class="list-group-item"><strong>Review:</strong> <?php echo $this->Html->link('Reviews', array('controller'=>'reviews','action'=>'index',$v['Store']['id'])); ?></li>
  
</ul>
<hr>
		<?php endforeach; ?>
	


<?php endif; ?>
<?php endif; ?>