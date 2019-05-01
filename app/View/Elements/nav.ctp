<div class="amh-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md">
                <a class="navbar-brand d-block d-md-none" href="#">KMVN</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#am_navbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="am_navbar">
                    <ul class="navbar-nav">
                        <?php /* <li class="nav-item active"><a class="nav-link" href="<?php echo Configure::read('siteUrlfront');  ?>">Home</a></li> */?>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0)">The Company <span class="nav-arrow"><i class="material-icons">keyboard_arrow_down</i></span></a>
                            <?php if(!empty($aboutMenu['Cms'])){ ?>
                                <div class="dropdown-menu" aria-labelledby="Product Dropdown">
                                    <?php foreach($aboutMenu['Cms'] as $about){ ?>
                                        <?php 
                                            $slug = $about['slug'];                                               
                                            echo $this->Html->link($about['title'],array(
                                                'controller' => 'pages',
                                                'action' => 'cms',                                        
                                                'slug' =>  $slug,
                                                
                                            ), array('escape' => FALSE,'class'=>'dropdown-item'));
                                        
                                        
                                        ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0)">Products <span class="nav-arrow"><i class="material-icons">keyboard_arrow_down</i></span></a>
                            <?php if(!empty($services)):  ?>
                                <div class="dropdown-menu" aria-labelledby="Product Dropdown">
                                    <?php
                                        foreach($services as $category){ 
                                            $slug = $category['Category']['slug'];                                               
                                            echo $this->Html->link($category['Category']['title'],array(
                                                'controller' => 'listing',
                                                'action' => 'index',                                        
                                                'slug' =>  $slug,
                                                
                                            ), array('escape' => FALSE,'class'=>'dropdown-item'));
                                        }
                                    ?>
                                </div>
                            <?php endif; ?>
                        </li>
                        <li class="nav-item">
                            <?php 
                                $slug = 'packaging';                                               
                                echo $this->Html->link('Packaging',array(
                                    'controller' => 'pages',
                                    'action' => 'cms',                                        
                                    'slug' =>  $slug,
                                    
                                ), array('escape' => FALSE,'class'=>'nav-link'));
                            
                            
                            ?>
                        </li>
                        <li class="nav-item">
                            <?php 
                                $slug = 'quality';                                               
                                echo $this->Html->link('Quality',array(
                                    'controller' => 'pages',
                                    'action' => 'cms',                                        
                                    'slug' =>  $slug,
                                    
                                ), array('escape' => FALSE,'class'=>'nav-link'));
                            
                            
                            ?>
                        </li>
                        <li class="nav-item">
                            <?php
                                echo $this->Html->link('Contact Us',array(
                                    'controller' => 'contact-us',
                                    'action' => 'index',                                        
                                    
                                ), array('escape' => FALSE,'class'=>'nav-link'));
                            ?>  
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>