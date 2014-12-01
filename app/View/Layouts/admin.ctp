<?php $cakeDescription = __d('cake_dev', 'Gluten Free'); ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title><?php echo $cakeDescription ?> | <?php echo $title_for_layout; ?></title>
	<meta name="description" content="Gluten Free">
	<meta name="author" content="Vanessa Montanha ">
	
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('cake.generic');
		echo $this->Html->css('generic');
		echo $this->Html->css('admin');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	
</head>
<body id="<?php echo $this->params['controller']; ?>" class="<?php echo $this->params['controller'].'_'.$this->params['action']; ?>">
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link($cakeDescription, array('controller'=>'stores','action'=>'index','admin'=>FALSE)); ?></h1>
			<ul>
				<li class="stores"><?php echo $this->Html->link('Restaurants', array('controller'=>'stores','action'=>'index')); ?></li>
				<li class="categories"><?php echo $this->Html->link('Allergies', array('controller'=>'categories','action'=>'index')); ?></li>
				<li class="reviews"><?php echo $this->Html->link('Reviews', array('controller'=>'reviews','action'=>'index')); ?></li>
				<li class="users"><?php echo $this->Html->link('Users', array('controller'=>'users','action'=>'index')); ?></li>
				<li class="logout"><?php echo $this->Html->link('Logout', array('controller'=>'users','action'=>'logout','admin'=>FALSE)); ?></li>
			</ul>
		</div>
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<p>Created by Vanessa Montanha &copy; <?php echo date("Y"); ?></p>
		</div>
	</div>

	
	<!-- JS
	================================================== -->
	<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
	<script>
		var default_latitude = '<?php echo Configure::read('Google.DefaultLatitude'); ?>';
		var default_longitude = '<?php echo Configure::read('Google.DefaultLongitude'); ?>';
	</script>
	<?php echo $this->Html->script('admin'); ?>
</body>
</html>