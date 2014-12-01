<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
      Applergy
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
<div class="panel-group" id="accordion">
    <!-- Start accordian -->
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">1. How to use the app?</a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse">  <!-- If put 'in' at the end of panel-collapse collapse, the accordian will always open at the beginning. -->
      <div class="panel-body">
         To make full use of Gluten Free mobile web application, we recommend you to use a device whose screen is no bigger than 760px. If you are still unsure on how to use the application you can send us a message for a detailed tutorial.

      </div>
    </div>
  </div>
  <!-- Finished accordian -->
    <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">2. Terms</a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
        <p>Gluten Free is a mobile web application. It can be used for any operating systems on mobile phones. </a></p>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">3. Privacy</a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        <p>At the moment our application only focuses on restaurants in the Greater Dublin area. We will add more restaurants soon.</a></p>
      </div>
    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">4. FAQ</a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse">
      <div class="panel-body">
        <p>Gluten Free is a name given for mobile web application which is combination of Gluten and Free.</a></p>
      </div>
    </div>
  </div>
 
   </div>
     
     
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <?php echo $this->Html->script('bootstrap.min'); ?>   
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
	<?php echo $this->fetch('scriptBottom'); ?>
	
</body>
</html>





