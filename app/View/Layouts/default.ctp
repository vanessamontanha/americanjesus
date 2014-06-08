<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

 $cakeDescription = __d('cake_dev','Applergy'); ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Applergy</title>
	<meta name="description" content="Applergy">
	<meta name="author" content="Vanessa Montanha">
	
	<?php
		echo $this->Html->meta('icon');
                echo $this->Html->css('cake.generic');
                echo $this->Html->css('generic');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('custom');
                echo $this->Html->css('navigation_top');
                echo $this->Html->css('nav_bottom');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
<?php if(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR']!='127.0.0.1'): ?>
	<script type="text/javascript">

	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-32383200-1']);
	_gaq.push(['_trackPageview']);

	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();

	</script>
	<?php endif; ?>
	
</head>
<body id="<?php echo $this->params['controller']; ?>" class="<?php echo $this->params['controller'].'_'.$this->params['action']; echo (isset($page))?'_'.$page:''; ?>">
	<div id="container">
		<?php echo $this->element('nav_top');?>
		<div id="content">
			<noscript><p class="error">Javascript needs to be enabled for the Store Locator to work</p></noscript>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->element('nav_bottom');?>
		</div>
	</div>
	
	
	<!-- JS
	================================================== -->
	<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
	<script type="text/javascript">
		var browser_geolocation = <?php echo (Configure::read('Feature.enable_browser_geolocation')) ? 'true' : 'false'; ?>;
		var default_latitude    = '<?php echo Configure::read('Google.DefaultLatitude'); ?>';
		var default_longitude   = '<?php echo Configure::read('Google.DefaultLongitude'); ?>';
	</script>
	<?php echo $this->Html->script('common'); ?>
        
         <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <?php echo $this->Html->script('bootstrap.min'); ?>   
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    	
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

	<?php echo $this->fetch('scriptBottom'); ?>
</body>
</html>