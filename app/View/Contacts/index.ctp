<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
                echo $this->Html->css('bootstrap.min.css');
                echo $this->Html->css('custom');
                

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>

<?php $this->Html->script('contact', array('block' => 'scriptBottom')); ?>

 

   <h2>Contact Us</h2>

<p>
	If you have any questions or suggestions, please send us a message. Your feedback is important for us!
</p>             
                
           
                
    
<?php echo $this->Form->create('Contact',array('class'=>'form-horizontal','inputDefaults'=>array('label'=>false)));?></p>
<div class="form-group"></div>

<div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
               <?php echo $this->Form->input('name',array('class'=>'form-control'));?></h3>
            </div></div>
<div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">E-mail</label>
            <div class="col-sm-10">
               <?php echo $this->Form->input('email',array('class'=>'form-control'));?></h3>
            </div></div>
<div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Telephone</label>
            <div class="col-sm-10">
               <?php echo $this->Form->input('telephone',array('class'=>'form-control'));?></h3>
            </div></div>
<div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Message</label></p>
            <div class="col-sm-10">
                <?php echo $this->Form->textarea('message',array('class'=>'form-control','rows'=>5));?>
            </div>
          </div>  
<p class="date"><div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <?php echo $this->Form->submit(__('Send'),array('class'=>'btn btn-primary'))?></p>
            </div>  </div>
</div>
       


</div>
 </body>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
   <?php echo $this->Html->script('bootstrap.min'); ?> 
</html>    