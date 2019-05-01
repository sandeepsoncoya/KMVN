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
								
								'/admin/dist/css/style.min.css',
								'/admin/assets/libs/toastr/build/toastr.min',  
							]);
		echo $this->Html->script([
			'/admin/assets/libs/jquery/dist/jquery.min', 
			'/admin/assets/libs/toastr/build/toastr.min',
			'/admin/assets/extra-libs/toastr/toastr-init',              
		]);
		echo $this->Html->script([
								
								'/admin/assets/libs/popper.js/dist/umd/popper.min.js',
								'/admin/assets/libs/bootstrap/dist/js/bootstrap.min.js',
														
								
							], array('block' => 'scriptBottom'));
		//echo $this->Html->css('/admin/vendor/bootstrap/css/dataTables.bootstrap4','/admin/vendor/bootstrap/css/sb-admin.css');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
	?>
	
</head>

<body >
	<div class="main-wrapper">
		<div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>				
		<?php echo $this->fetch('content'); ?>           

    </div>
 <?php echo $this->fetch('scriptBottom'); ?>
 <script>
	$('[data-toggle="tooltip"]').tooltip();
	$(".preloader").fadeOut();
	// ============================================================== 
	// Login and Recover Password 
	// ============================================================== 
	$('#to-recover').on("click", function() {
		$("#loginform").slideUp();
		$("#recoverform").fadeIn();
	});
</script>
</body>
</html>
