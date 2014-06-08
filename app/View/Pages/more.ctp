<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        If I live to see the seven wonders...
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
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">News</a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse">  <!-- If put 'in' at the end of panel-collapse collapse, the accordian will always open at the beginning. -->
      <div class="panel-body">
        <p>Lalalalalalalalalalalalalalal</p>
      </div>
    </div>
  </div>
  <!-- Finished accordian -->
    <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">About Us</a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
        <p>Applergy is a mobile web application. It can be used for any operating systems on mobile phones. Just type m.applergy.com in the browser and applergy will be loaded onto the screen.</a></p>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Feedback</a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        <p>At the moment our application only focus on restaurants in Greater Dublin area. We will add more restaurants soon.</a></p>
      </div>
    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">Contact</a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse">
      <div class="panel-body">
        <p>Applergy is a name given for mobile web application which is combination of Application and Allergy.</a></p>
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