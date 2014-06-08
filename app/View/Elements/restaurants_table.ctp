<?php if(isset($stores) && !empty($stores)): ?>
<?php if($_feature_show_results_table): ?>
<table id="stores_table">
	<thead>
		<tr>
			<th>Name</th>
			<th>Address</th>
			<th>Telephone</th>
			<th>Stars</th>
			<th>Distance</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($stores as $k=>$v): ?>
		<tr>
			<td><?php
				if($v['Store']['url']) {
					echo '<a href="'.$v['Store']['url'].'" target="_blank">'.h($v['Store']['name']).'</a>';
				} else {
					echo h($v['Store']['name']);
				}
			?></td>
			<td><?php echo h(str_replace("\n", ", ", $v['Store']['address'])); ?></td>
			<td><?php echo ($v['Store']['telephone_number']) ? $v['Store']['telephone_number'] : 'n/a'; ?></td>
			<td><span class="stars star_<?php echo $v['Store']['rating']; ?>"></span></td>
			<td><?php echo (isset($v[0]['distance'])) ? round($v[0]['distance'],2).' '.$_search_distance : 'n/a'; ?></td>
			<td class="acenter"><?php echo $this->Html->link('Reviews', array('controller'=>'reviews','action'=>'index',$v['Store']['id'])); ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php endif; ?>
<?php endif; ?>