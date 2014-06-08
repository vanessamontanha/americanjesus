
        
	<h3>Restaurants</h3>
  
	<?php if (!empty($category['Store'])): ?>
        
        <?php foreach ($category['Store'] as $store): ?>
	
        <div class="row col-xs-12">
       <ul class="list-group">
  <li class="list-group-item"><p><strong><?php echo __('Name'); ?></strong>: <?php echo $store['name']; ?></p></li>
  <li class="list-group-item"><p><strong><?php echo __('Address'); ?></strong>: <?php echo $store['address']; ?></p></li>
   <li class="list-group-item"><p><strong><?php echo __('Telephone'); ?></strong>: <?php echo $store['telephone_number']; ?></p></li>
     <li class="list-group-item"><p><strong><?php echo __('Description'); ?></strong>: <?php echo $store['description']; ?></p></li>
      <li class="list-group-item"><p><strong><?php echo __('Cuisine'); ?></strong>: <?php echo $store['cuisine']; ?></p></li>
      <li class="list-group-item"><p><strong><?php echo __('Menu'); ?></strong>: <?php echo $this->Html->link('Click here',$store['url'])?></p></li>

        </div>
                
	<?php endforeach; ?>
	
<?php endif; ?>

   
	