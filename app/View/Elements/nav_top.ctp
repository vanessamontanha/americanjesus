<div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php echo $this->Html->link(__('Applergy'),'/',array('class'=>'navbar-brand'));?>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
              <li><?php echo $this->Html->link(__('Allergies'),array('controller'=>'categories','action'=>'index'))?></li>
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Restaurants <b class="caret"></b></a>
              <ul class="dropdown-menu">
                 
                    <li> <?php echo $this->Html->link(__('Find One'),array('controller'=>'stores','action'=>'index'))?></li>
                 <li>
                    <?php echo $this->Html->link(__('Send a Suggestion'),array('controller'=>'stores','action'=>'add'))?></li>
                 
                 
             
            
            
          </ul>
              
              <li><?php echo $this->Html->link(__('Contact'),array('controller'=>'contacts','action'=>'index'))?></li>
              <li><?php echo $this->Html->link(__('Information'),array('controller'=>'pages','action'=>'about'))?></li>
           
              <li><?php echo $this->Html->link('News', 'http://www.applergy.wordpress.com', array('target' => '_blank')); ?></li>
        </div><!--/.nav-collapse -->
      </div>
</div>
