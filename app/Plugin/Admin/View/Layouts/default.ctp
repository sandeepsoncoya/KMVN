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
<html dir="ltr">
<head>

	<?php echo $this->Html->charset(); ?>
	<title>	
        <?php $siteTitle =  Configure::read('SiteTitle')!==""? Configure::read('SiteTitle')." - ":''; ?>	
		<?php echo $siteTitle.$this->fetch('title'); ?>
	</title>
	<?php
    
    echo $this->Html->meta('icon',Configure::read('favicon'), ['type'=>'image/png']);
    echo $this->Html->css([
                '/admin/assets/libs/chartist/dist/chartist.min',
                '/admin/assets/extra-libs/c3/c3.min', 
                '/admin/assets/extra-libs/DataTables/datatables.min',              
                '/admin/dist/css/sweetalert',     
                '/admin/assets/libs/toastr/build/toastr.min',     
                '/admin/assets/libs/select2/dist/css/select2.min',     
                '/admin/dist/css/style.min',
            ]);
    echo $this->Html->script([
                '/admin/assets/libs/jquery/dist/jquery.min', 
                '/admin/assets/libs/toastr/build/toastr.min',
                '/admin/assets/extra-libs/toastr/toastr-init',
                '/admin/assets/extra-libs/ckeditor/ckeditor',
                '/admin/assets/extra-libs/ckfinder/ckfinder',              
            ]);
    echo $this->Html->script([
                '/admin/assets/libs/jquery/dist/jquery.min',
                '/admin/assets/libs/popper.js/dist/umd/popper.min',
                '/admin/assets/extra-libs/DataTables/datatables.min',
                '/admin/assets/libs/bootstrap/dist/js/bootstrap.min',
                '/admin/dist/js/app.min',
                '/admin/assets/libs/popper.js/dist/umd/popper',
                '/admin/dist/js/app.init',
                '/admin/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min',
                '/admin/assets/libs/select2/dist/js/select2.full.min',
                '/admin/assets/extra-libs/sparkline/sparkline',
                '/admin/dist/js/waves',
                '/admin/dist/js/sidebarmenu',
                '/admin/dist/js/sweetalert',          
                '/admin/dist/js/custom',
                '/admin/dist/js/pages/chartjs/chartjs.init',
                '/admin/assets/libs/Chart.js/dist/Chart.min',
            ], array('block' => 'scriptBottom'));
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script'); 
  ?>

	<script type="text/javascript">
    var siteUrl ='<?php echo Configure::read('siteUrl');  ?>'; 
  </script>
</head>
<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php echo $this->element('header'); ?>
    
        <?php echo $this->element('navigation'); ?>
       
        <div class="page-wrapper">
           
            <?php 
            
            echo $this->element('breadcrumb'); 
            
            echo $this->Flash->render(); 
            
            ?> 
            
            <div class="container-fluid">
               
                <?php echo $this->fetch('content'); ?>
            
            </div>
            <div id="form_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                
            </div>
           
            <footer class="footer text-center">
                Shubhan Prints
            </footer>
          
        </div>
       
    </div>
   
<?php  echo $this->fetch('scriptBottom'); ?>
<?php  echo $this->fetch('cssBottom'); ?>

</body>
</html>
