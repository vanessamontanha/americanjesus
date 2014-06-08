<h2>Send a Suggestion</h2>

<p>
	Know a restaurant that serves delicious allergy free food? Send it to us so it can be part of our database. Note this addition is subjected to approval.
</p>


<?php echo $this->Form->create('Store',array('class'=>'form-horizontal','inputDefaults'=>array('label'=>false)));?></p>
   
<div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Allergy</label>
            <div class="col-sm-10">
               <?php echo $this->Form->input('category_id',array('class'=>'form-control'));?></h3>
            </div></div>   
<div class="form-group">
    <a href="#" data-toggle="tooltip" title="Enter Restaurant name only. No special characters allowed eg. Baan Thai"><label for="inputPassword3" class="col-sm-2 control-label">Restaurant</label></a>
              
            <div class="col-sm-10">
               <?php echo $this->Form->input('name',array('class'=>'form-control'));?></h3>
            </div></div>



<div id="address_wrapper">
    <div class="form-group">
              <a href="#" data-toggle="tooltip" title="Enter the Street and area only. No special characters allowed e.g Dame Street Dublin 2"><label for="inputPassword3" class="col-sm-2 control-label">Address</label></a>
            <div class="col-sm-10">
               <?php echo $this->Form->textarea('address',array('class'=>'form-control','rows'=>3,'after' => '<small>The address will be looked up after moving onto the next field</small>' ));?>
            </div></div>
    
	
	
</div>
   <?php
echo $this->Form->input('lat',array('type'=>'hidden'));
echo $this->Form->input('lng',array('type'=>'hidden')); ?>

    <div class="form-group"></div>
<div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Telephone</label>
            <div class="col-sm-10">
               <?php echo $this->Form->input('telephone_number',array('class'=>'form-control'));?></h3>
            </div></div>   
<div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Email Address</label>
            <div class="col-sm-10">
               <?php echo $this->Form->input('email_address',array('class'=>'form-control'));?></h3>
            </div></div>
     <div class="form-group"></div>
<div class="form-group">
              <a href="#" data-toggle="tooltip" title="Example: http://wwww.google.com"><label for="inputPassword3" class="col-sm-2 control-label">URL</label></a>
            <div class="col-sm-10">
               <?php echo $this->Form->input('url',array('class'=>'form-control'));?></h3>
            </div></div>   
<div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Cuisine</label>
            <div class="col-sm-10">
               <?php echo $this->Form->input('name',array('class'=>'form-control'));?></h3>
            </div></div>


  



<?php echo $this->Form->end('Save'); ?>