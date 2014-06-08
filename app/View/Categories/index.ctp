

            <div class="row">
    <div class="col-lg-12">
       
            <?php if(isset($categories) && !empty($categories)): ?> 
        <?php foreach($categories as $k=>$category): ?> <tr> 
             <?php echo $this->Html->link($this->Html->image('icons/'.$category['Category']['icon']),array('action' => 'view', $category['Category']['id']),array('escape' => false)); ?>
         <!-- <td class="actions"> <?php echo $this->Html->link(__('View'), array('action' => 'view', $category['Category']['id'])); ?> </td>--> </tr> <?php endforeach; ?>  
      
        
    </div>
     
</div>


<div class="button">
  <div class="col-xs-12"><?php echo $this->Html->link(__('Restaurants Nearby'), array('controller' => 'stores', 'action' => 'index')); ?></div>
</div>

  
 <?php else: ?> <tr><td colspan="2">Currently no Allergy Categories to display</td></tr> <?php endif; ?>
    
    
    
    

 