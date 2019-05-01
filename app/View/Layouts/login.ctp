<?php 
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

//$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
//$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>		
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css([
								'/css/font-face',
								'/vendor/bootstrap-4.1/bootstrap.min',
								'/vendor/font-awesome-4.7/css/font-awesome.min',
								'/vendor/animsition/animsition.min',
								'/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css',
								'/vendor/wow/animate',
								'/vendor/css-hamburgers/hamburgers.min',
								'/vendor/slick/slick',
								
								'/vendor/perfect-scrollbar/perfect-scrollbar',
								'/vendor/mdi-font/css/material-design-iconic-font.min',
								'/css/theme',
								'/css/style'
							]);
		echo $this->Html->script([
                '/admin/vendor/jquery-3.2.1.min',
                '/admin/js/moment.min',
                '/admin/js/fullcalendar.min',
                '/admin/vendor/bootstrap-4.1/popper.min',
                '/admin/vendor/bootstrap-4.1/bootstrap.min',
                '/admin/vendor/slick/slick.min',
                '/admin/vendor/wow/wow.min',
                '/admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min',
                '/admin/vendor/counter-up/jquery.waypoints.min',
                '/admin/vendor/counter-up/jquery.counterup.min',
                
                '/admin/vendor/circle-progress/circle-progress.min',
                '/admin/vendor/animsition/animsition.min',
                '/admin/vendor/perfect-scrollbar/perfect-scrollbar',
                '/admin/vendor/chartjs/Chart.bundle.min',
                '/admin/vendor/select2/select2.min',
                '/admin/vendor/bootstrap-datepicker.min',
                '/admin/js/main',
                
              ], array('block' => 'scriptBottom'));
		//echo $this->Html->css('/vendor/bootstrap/css/dataTables.bootstrap4','/vendor/bootstrap/css/sb-admin.css');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		
	?>
	<script type="text/javascript">
	    var siteUrl ='<?php echo Configure::read('siteUrl');  ?>'; 
	  </script>
</head>

<body >
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
				<?php echo $this->fetch('content'); ?>
            </div>
        </div>

    </div>
<?php  echo $this->fetch('scriptBottom'); ?>

</body>
</html>
