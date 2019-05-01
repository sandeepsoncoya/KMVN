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
<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <?php echo $this->Html->charset(); ?>
      <?php
         echo $this->fetch('meta');
         ?>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="apple-mobile-web-app-capable" content="yes" />
      <meta name="apple-mobile-web-app-status-bar-style" content="white-translucent" />
      <!-- Favicon -->
      <link rel="apple-touch-icon" sizes="57x57" href="<?php echo Configure::read('siteUrlfront');  ?>images/favicon/apple-icon-57x57.png" />
      <link rel="apple-touch-icon" sizes="60x60" href="<?php echo Configure::read('siteUrlfront');  ?>images/favicon/apple-icon-60x60.png" />
      <link rel="apple-touch-icon" sizes="72x72" href="<?php echo Configure::read('siteUrlfront');  ?>images/favicon/apple-icon-72x72.png" />
      <link rel="apple-touch-icon" sizes="76x76" href="<?php echo Configure::read('siteUrlfront');  ?>images/favicon/apple-icon-76x76.png" />
      <link rel="apple-touch-icon" sizes="114x114" href="<?php echo Configure::read('siteUrlfront');  ?>images/favicon/apple-icon-114x114.png" />
      <link rel="apple-touch-icon" sizes="120x120" href="<?php echo Configure::read('siteUrlfront');  ?>images/favicon/apple-icon-120x120.png" />
      <link rel="apple-touch-icon" sizes="144x144" href="<?php echo Configure::read('siteUrlfront');  ?>images/favicon/apple-icon-144x144.png" />
      <link rel="apple-touch-icon" sizes="152x152" href="<?php echo Configure::read('siteUrlfront');  ?>images/favicon/apple-icon-152x152.png" />
      <link rel="apple-touch-icon" sizes="180x180" href="<?php echo Configure::read('siteUrlfront');  ?>images/favicon/apple-icon-180x180.png" />
      <link rel="icon" type="image/png" sizes="192x192" href="<?php echo Configure::read('siteUrlfront');  ?>images/favicon/android-icon-192x192.png" />
      <link rel="icon" type="image/png" sizes="32x32" href="<?php echo Configure::read('siteUrlfront');  ?>images/favicon/favicon-32x32.png" />
      <link rel="icon" type="image/png" sizes="96x96" href="<?php echo Configure::read('siteUrlfront');  ?>images/favicon/favicon-96x96.png" />
      <link rel="icon" type="image/png" sizes="16x16" href="<?php echo Configure::read('siteUrlfront');  ?>images/favicon/favicon-16x16.png" />
<!--       <link rel="manifest" href="manifest.json" />
 -->      <meta name="msapplication-TileColor" content="#570409" />
      <meta name="msapplication-TileImage" content="images/favicon/ms-icon-144x144.png" />
      <meta name="theme-color" content="#570409" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
      <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700|Open+Sans:400,600|Poppins:500,600,700,800|Roboto:500|Material+Icons" rel="stylesheet" />
          <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

      <?php 
       

         echo $this->Html->css([
             'owl.carousel.min',
             'animate',
             'slick',
             'lightgallery.min',
             '/admin/dist/css/sweetalert',
             'style'
         ]);
         
         echo $this->fetch('css');
         echo $this->fetch('script');   
         ?>
      <title>     
         <?php echo $this->fetch('title'); ?>
      </title>
      <?php 
         $metaKeyword =  (isset($keyWord))?$keyWord:'';
         $metaDescription =  (isset($metaDescription))?$metaDescription:'';
         
         ?>
      <?php  $this->Html->meta("keywords", $metaKeyword, array("inline" => false)); ?>
      <?php  $this->Html->meta("description", $metaDescription, array("inline" => false)); ?>
      <script type="text/javascript"> var siteUrlfront = "<?php echo Configure::read('siteUrlfront');?>";</script>
      <?php if (isset($newsFinalArray)) {
         $newsArr  = $newsFinalArray;
        }else{
          $newsArr  = [];
         } ?>
      <script type="text/javascript"> 
         var  contentSlider = <?php echo json_encode($newsArr); ?>;
         var loc;
      </script>
   </head>
   <body>
      <div id="fb-root"></div>
      <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.2"></script>
      <header class="vh-head">
         <?php echo $this->element('header'); ?>
      </header>
      <?php echo $this->fetch('content'); ?>
      <?php echo $this->element('footer'); ?>
      <div class='menu-overlay'></div>
      <?php  echo $this->fetch('scriptBottom'); ?>
   </body>
</html>