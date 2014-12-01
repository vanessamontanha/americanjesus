
<?php if(isset($distances_error) && $distances_error): ?>
<p class="error">Invalid Distance options, please check the app/Default/Core.php file</p>
<?php endif; ?>

<div class="map_wrapper">
    
    <div class="row">
       
            <div class="col-xs-12">
    <div class="main">
		<div id="map_canvas"></div>
	</div>
                
	<div class="col-xs-12">
            
           <?php echo $this->Form->create('Store',array('class'=>'form-horizontal','inputDefaults'=>array('label'=>false)));?>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Distance</label>
            <div class="col-sm-10">
               <?php echo $this->Form->input('distance',array('class'=>'form-control', 'options'=> $options_distances, 'value'=>15));?></h3>
            </div></div> 
            
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Allergies</label>
            <div class="col-sm-10">
            <?php
            if(!empty($categories)) {
			echo $this->Form->input('category',array('class'=>'form-control','options'=>$categories));
		}
                
             ?></div></div>
            
            
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Address</label>
            <div class="col-sm-10">
               <?php echo $this->Form->textarea('address',array('class'=>'form-control','rows'=>3,'after' => '<small>The address will be looked up after moving onto the next field</small>' ));?>
            </div></div>
            <?php 
            echo $this->Form->input('default_distances',array('type'=>'hidden','value'=>$default_distances));
		echo $this->Form->input('lat',array('type'=>'hidden'));
		echo $this->Form->input('lng',array('type'=>'hidden'));
                echo $this->Form->end('Search');
            ?>
            
            
            
            
	</div>
	
</div>
            </div>
	
</div>
    </div>
	
