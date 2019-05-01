<?php

    use Cake\Routing\Router;
    $controller = $this->request->controller;
    $action = $this->request->action;

    $slug= isset($this->request->params['slug']) ? $this->request->params['slug'] : '';

    $home = $hotels = $destinations = $tour = $contacts = $aboutUs = $activities = $banquets =  '';
     switch($controller){
            case 'pages':
                if ($slug == 'about') {
                     $home = '';
                }else{
                     $home = 'active';
                }
                break;
            case 'hotels':
                $hotels = 'active';
                break;
            case 'destinations':
                $destinations = 'active';
                break;
            case 'activities':
                $activities = 'active';
                break;
            case 'banquets':
                $banquets = 'active';
                break;
             case 'tourPackages':
                $tour = 'active';
                break;
             case 'tour-packages':
                $tour = 'active';
                break;
             case 'contacts':
                $contacts = 'active';
                break;
             
            }


            $tourcat = $this->App->getTourCategoryList();
?>
<div class="container">
    <nav class="navbar navbar-expand-lg">
        <?php echo $this->Html->link($this->Html->image($logo, array('alt' =>'Logo')),
                            array('controller' => 'pages', 'action' => 'home'),
                            array('escape' => false, 'rel' => 'nofollow')
                        ); ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#vh_nav"
            aria-controls="vh_nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="vh_nav">
            <ul class="navbar-nav mr-auto">
                <?php /*<li class="nav-item <?= $home ?>">
                    <?php echo $this->Html->link('Home','/pages/home',array('class'=>'nav-link')); ?>
                </li> */?>
                <li class="nav-item <?php if($slug == 'about') echo "active"; ?>">
                    <?php echo $this->Html->link('About Us','/pages/about',array('class'=>'nav-link')); ?>
                </li>
                <li class="nav-item <?= $hotels ?>">
                    <?php echo $this->Html->link('Hotels','/hotels',array('class'=>'nav-link')); ?>
                </li>
                <li class="nav-item <?= $banquets ?>">
                    <?php echo $this->Html->link('Banquet','/banquets',array('class'=>'nav-link')); ?>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Packages
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php 
                        foreach ($tourcat as $key => $value) {
                            echo $this->Html->link($value['TourCategories']['name'],'/tour-packages/'.$value['TourCategories']['slug'],array('class'=>'dropdown-item'));
                        }
                        ?>  
                    </div>
                </li>
                <li class="nav-item <?= $destinations ?>">
                    <?php echo $this->Html->link('Destinations','/destinations',array('class'=>'nav-link')); ?>
                </li>
                <!-- <li class="nav-item <?= $tour ?>">
                    <?php //echo $this->Html->link('Packages','/tour-packages',array('class'=>'nav-link')); ?>
                </li> -->
                <li class="nav-item <?= $activities ?>">
                    <?php echo $this->Html->link('Activities','/activities',array('class'=>'nav-link')); ?>
                </li>
                <li class="nav-item <?= $contacts ?>">
                    <?php echo $this->Html->link('Contact Us','/contacts',array('class'=>'nav-link')); ?>
                </li>
            </ul>
        </div>
    </nav>
</div>