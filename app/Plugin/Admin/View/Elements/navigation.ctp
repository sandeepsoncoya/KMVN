<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                <?php 
                $roleId = 0;
                if($this->Session->check('Auth.User')){
                    $userData = $this->Session->read('UserData');
                    $roleId = $userData['Users']['role'];
                }
                //pr($this->Session->read('UserData')); die;
                /*if($userData =$this->Session->read('UserData')){
                    $roleId = $userData['Users']['role'];
                }*/
                
                $moduleArr = $this->navigation->getModuleAccess($roleId); 
                $subModuleArr = $this->navigation->getSubModuleAccess($roleId); 
                //pr($subModuleArr); die;
                //for dashboard
                if(in_array(1, $moduleArr)){
                ?>
                    <li class="sidebar-item">
                    
                        <?php echo $this->Html->link(
                            $this->Html->tag('span', '<i class="mdi mdi-av-timer"></i> Dashboard', array('class' => 'hide-menu')),
                            array('controller' => 'Users', 'action' => 'dashboard'),
                            array('escape' => FALSE,'class'=>'sidebar-link waves-effect waves-dark sidebar-link')
                        ); ?>
                        
                    </li>
                <?php 
                }
               
                //for site setting
                if(in_array(2, $moduleArr)){
                ?>
                    <li class="sidebar-item">
                        <?php echo $this->Html->link(
                            $this->Html->tag('span', '<i class="fa fa-cog"></i> Site Settings', array('class' => 'hide-menu')),
                            array('controller' => 'site_settings', 'action' => 'index',1),
                            array('escape' => FALSE,'class'=>'sidebar-link waves-effect waves-dark sidebar-link')
                        ); ?>
                    </li>
                <?php 
                }

                //for CMS
                if(in_array(3, $moduleArr)){
                    $subArr = $subModuleArr[3];
                ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-content-paste"></i>
                            <span class="hide-menu">CMS</span>
                           
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <?php 

                            //cms category
                            if(in_array(1, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-adjust"></i> Cms Category', array('class' => 'hide-menu')),
                                    array('controller' => 'category', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } 
                            //list
                            if(in_array(2, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-adjust"></i> List', array('class' => 'hide-menu')),
                                    array('controller' => 'cms', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php }
                            //add
                            if(in_array(3, $subArr)){
                            ?> 
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-adjust"></i> Add', array('class' => 'hide-menu')),
                                    array('controller' => 'cms', 'action' => 'add'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } ?>
                            
                        </ul>
                    </li>
                <?php 
                }
                

                //for Slider
                if(in_array(4, $moduleArr)){
                    $subArr = $subModuleArr[4];
                ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi  mdi-camera-burst"></i>
                            <span class="hide-menu">Slider</span>
                           
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <?php 
                            //list
                            if(in_array(4, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-adjust"></i> List', array('class' => 'hide-menu')),
                                    array('controller' => 'slider', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                            </li>
                            <?php }
                            //add
                            if(in_array(5, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-adjust"></i> Add', array('class' => 'hide-menu')),
                                    array('controller' => 'slider', 'action' => 'add'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } ?>
                        </ul>
                    </li>

                <?php 
                }

                //for Attraction
                if(in_array(5, $moduleArr)){
                    $subArr = $subModuleArr[5];
                ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi  mdi-weather-pouring"></i>
                            <span class="hide-menu">Attraction</span>
                           
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">

                            <?php 
                            //list
                            if(in_array(6, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-format-list-bulleted"></i> List', array('class' => 'hide-menu')),
                                    array('controller' => 'attraction', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php }
                            //add
                            if(in_array(7, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-shape-square-plus"></i> Add', array('class' => 'hide-menu')),
                                    array('controller' => 'attraction', 'action' => 'add'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } ?>
                        </ul>
                    </li>

                <?php 
                }

                //for TourPackage
                if(in_array(6, $moduleArr)){
                    $subArr = $subModuleArr[6];
                ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi  mdi-book-multiple"></i>
                            <span class="hide-menu">TourPackage</span>
                           
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <?php 
                            //list
                            if(in_array(8, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-format-list-bulleted"></i> List', array('class' => 'hide-menu')),
                                    array('controller' => 'tourPackage', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                            </li>
                            <?php }
                            //add
                            if(in_array(9, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-shape-square-plus"></i> Add', array('class' => 'hide-menu')),
                                    array('controller' => 'tourPackage', 'action' => 'add'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                            </li>
                            <?php } ?>
                            
                        </ul>
                    </li>

                <?php 
                }
                //for Tour Categories
                if(in_array(7, $moduleArr)){
                    $subArr = $subModuleArr[7];
                ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi  mdi-book-multiple"></i>
                            <span class="hide-menu">Tour Categories</span>
                           
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <?php 
                            //list
                            if(in_array(10, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-format-list-bulleted"></i> List', array('class' => 'hide-menu')),
                                    array('controller' => 'TourCategories', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } ?>
                            
                        </ul>
                    </li>
                <?php 
                }

                //for Destinations
                if(in_array(8, $moduleArr)){
                    $subArr = $subModuleArr[8];
                ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi  mdi-airplane"></i>
                            <span class="hide-menu">Destinations</span>
                           
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <?php 
                            //list
                            if(in_array(11, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-format-list-bulleted"></i> List', array('class' => 'hide-menu')),
                                    array('controller' => 'Destination', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php }
                            //add
                            if(in_array(12, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-shape-square-plus"></i> Add', array('class' => 'hide-menu')),
                                    array('controller' => 'Destination', 'action' => 'add'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php 
                }
                //for Company
                if(in_array(9, $moduleArr)){
                    $subArr = $subModuleArr[9];
                ?>
                    <!--company starts-->
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="fa fa-building" aria-hidden="true"></i>
                            <span class="hide-menu">Company</span>
                           
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <?php 
                            //add
                            if(in_array(13, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-format-list-bulleted"></i> List', array('class' => 'hide-menu')),
                                    array('controller' => 'Company', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                            </li>
                            <?php }
                            //add
                            if(in_array(14, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-shape-square-plus"></i> Add', array('class' => 'hide-menu')),
                                    array('controller' => 'Company', 'action' => 'add'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <!--company ends-->
                <?php 
                }

                //for company users
                if(in_array(10, $moduleArr)){
                    $subArr = $subModuleArr[10];
                ?>
                    <!--company users starts-->
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span class="hide-menu">Company Users</span>
                           
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <?php 
                            //List
                            if(in_array(15, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-format-list-bulleted"></i> List', array('class' => 'hide-menu')),
                                    array('controller' => 'company_users', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } 
                            //add
                            if(in_array(16, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-shape-square-plus"></i> Add', array('class' => 'hide-menu')),
                                    array('controller' => 'company_users', 'action' => 'add'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <!--company users ends-->
                <?php 
                }

                //for Roles
                if(in_array(11, $moduleArr)){
                    $subArr = $subModuleArr[11];
                ?>
                    <!--Roles Starts-->
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi  mdi-book-multiple"></i>
                            <span class="hide-menu">Roles</span>
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <?php 
                            //List
                            if(in_array(17, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-shape-square-plus"></i> Add', array('class' => 'hide-menu')),
                                    array('controller' => 'roles', 'action' => 'add'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } 
                            //Add
                            if(in_array(18, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-format-list-bulleted"></i> List', array('class' => 'hide-menu')),
                                    array('controller' => 'Roles', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <!--Roles Ends-->
                <?php 
                }

                //for Users
                if(in_array(12, $moduleArr)){
                    $subArr = $subModuleArr[12];
                ?>
                    <!--users starts-->
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span class="hide-menu">Users</span>
                           
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <?php 
                            //List
                            if(in_array(19, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-format-list-bulleted"></i> List', array('class' => 'hide-menu')),
                                    array('controller' => 'users', 'action' => 'list_users'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } 
                            //Add
                            if(in_array(20, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-shape-square-plus"></i> Add', array('class' => 'hide-menu')),
                                    array('controller' => 'users', 'action' => 'add_user'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <!--users ends-->
                <?php 
                }

                //for hotels
                if(in_array(13, $moduleArr)){
                    $subArr = $subModuleArr[13];
                ?>
                    <!--hotels starts-->
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-hotel"></i>
                            <span class="hide-menu">Hotels</span>
                           
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <?php 
                            //List
                            if(in_array(21, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-adjust"></i> Hotel Category', array('class' => 'hide-menu')),
                                    array('controller' => 'hotel_category', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } 
                            //Rate Code
                            if(in_array(22, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-adjust"></i> Rate Code', array('class' => 'hide-menu')),
                                    array('controller' => 'rate_code', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php }
                            //Rate Inclusion
                            if(in_array(23, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-adjust"></i> Rate Inclusion', array('class' => 'hide-menu')),
                                    array('controller' => 'rate_include', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php }
                            //Hotel Facilities
                            if(in_array(24, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-adjust"></i> Hotel Facilities', array('class' => 'hide-menu')),
                                    array('controller' => 'hotel_facilities', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php }
                            //Hotel Facility Type
                            if(in_array(25, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-adjust"></i> Hotel Facility Type', array('class' => 'hide-menu')),
                                    array('controller' => 'hotel_facilities_info', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php 
                            }
                            //Hotel Highlight
                            if(in_array(26, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-adjust"></i> Hotel Highlight', array('class' => 'hide-menu')),
                                    array('controller' => 'hotel_highlight', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php 
                            }
                            //Room Facility Type
                            if(in_array(27, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-adjust"></i> Room Facility Type', array('class' => 'hide-menu')),
                                    array('controller' => 'room_facility', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php 
                            }
                            //Room Facility
                            if(in_array(28, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-adjust"></i> Room Facility', array('class' => 'hide-menu')),
                                    array('controller' => 'room_facility_info', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php 
                            }
                            //Bed Type
                            if(in_array(29, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-adjust"></i> Bed Type', array('class' => 'hide-menu')),
                                    array('controller' => 'bed_type', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php 
                            }
                            //Hotel List
                            if(in_array(30, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-adjust"></i>Hotel List', array('class' => 'hide-menu')),
                                    array('controller' => 'hotels', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php 
                            }
                            //Hotel Add
                            if(in_array(31, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-adjust"></i>Hotel Add', array('class' => 'hide-menu')),
                                    array('controller' => 'hotels', 'action' => 'add'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php 
                            }
                            ?>
                        </ul>
                    </li>
                    <!--hotels ends-->
                <?php 
                }

                //for Tender Categories
                if(in_array(14, $moduleArr)){
                    $subArr = $subModuleArr[14];
                ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-format-line-weight"></i>
                            <span class="hide-menu">Tender Categories</span>
                           
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <?php 
                            //List
                            if(in_array(32, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-format-list-bulleted"></i> List', array('class' => 'hide-menu')),
                                    array('controller' => 'TenderCategories', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php 
                }

                //for Tenders
                if(in_array(15, $moduleArr)){
                    $subArr = $subModuleArr[15];
                ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-book-open-variant"></i>
                            <span class="hide-menu">Tenders</span>
                           
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <?php 
                            //List
                            if(in_array(33, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-format-list-bulleted"></i> List', array('class' => 'hide-menu')),
                                    array('controller' => 'Tenders', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } 
                            //Add
                            if(in_array(34, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-shape-square-plus"></i> Add', array('class' => 'hide-menu')),
                                    array('controller' => 'Tenders', 'action' => 'add'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php 
                }

                //for New & Events
                if(in_array(16, $moduleArr)){
                    $subArr = $subModuleArr[16];
                ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-newspaper"></i>
                            <span class="hide-menu">New & Events</span>
                           
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <?php  
                            //List
                            if(in_array(35, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-format-list-bulleted"></i> List', array('class' => 'hide-menu')),
                                    array('controller' => 'News', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } 
                            //Add
                            if(in_array(36, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-shape-square-plus"></i> Add', array('class' => 'hide-menu')),
                                    array('controller' => 'News', 'action' => 'add'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php 
                }


                //for Services
                if(in_array(17, $moduleArr)){
                    $subArr = $subModuleArr[17];
                ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-file-image"></i>
                            <span class="hide-menu">Services</span>
                           
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <?php  
                            //List
                            if(in_array(37, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-format-list-bulleted"></i> List', array('class' => 'hide-menu')),
                                    array('controller' => 'services', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } 
                            //Add
                            if(in_array(38, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-shape-square-plus"></i> Add', array('class' => 'hide-menu')),
                                    array('controller' => 'services', 'action' => 'add'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php }
                            ?>
                        </ul>
                    </li>
                <?php 
                }

                //for Gallery
                if(in_array(18, $moduleArr)){
                    $subArr = $subModuleArr[18];
                ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-file-image"></i>
                            <span class="hide-menu">Gallery</span>
                           
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <?php  
                            //List
                            if(in_array(39, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-format-list-bulleted"></i> List', array('class' => 'hide-menu')),
                                    array('controller' => 'Gallery', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } 
                            //Add
                            if(in_array(40, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-shape-square-plus"></i> Add', array('class' => 'hide-menu')),
                                    array('controller' => 'Gallery', 'action' => 'add'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php 
                }

                //for FAQ`s
                if(in_array(19, $moduleArr)){
                    $subArr = $subModuleArr[19];
                ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-comment-question-outline"></i>
                            <span class="hide-menu">FAQ`s</span>
                           
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <?php  
                            //List
                            if(in_array(41, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-format-list-bulleted"></i> List', array('class' => 'hide-menu')),
                                    array('controller' => 'Faqs', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php 
                }

                //for Cities
                if(in_array(20, $moduleArr)){
                    $subArr = $subModuleArr[20];
                ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-city"></i>
                            <span class="hide-menu">Cities</span>
                           
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <?php  
                            //List
                            if(in_array(42, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-format-list-bulleted"></i> List', array('class' => 'hide-menu')),
                                    array('controller' => 'City', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php 
                }

                //for States
                if(in_array(21, $moduleArr)){
                    $subArr = $subModuleArr[21];
                ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-format-align-center"></i>
                            <span class="hide-menu">States</span>
                           
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <?php  
                            //List
                            if(in_array(43, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-format-list-bulleted"></i> List', array('class' => 'hide-menu')),
                                    array('controller' => 'States', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php 
                }

                //for Contacts
                if(in_array(22, $moduleArr)){
                    $subArr = $subModuleArr[22];
                ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-file-image"></i>
                            <span class="hide-menu">Contacts</span>
                           
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <?php  
                            //List
                            if(in_array(44, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-format-list-bulleted"></i> List', array('class' => 'hide-menu')),
                                    array('controller' => 'contacts', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php 
                }

                //for Contact Inquiries
                if(in_array(23, $moduleArr)){
                    $subArr = $subModuleArr[23];
                ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-file-image"></i>
                            <span class="hide-menu">Contact Inquiries</span>
                           
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <?php  
                            //List
                            if(in_array(45, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-format-list-bulleted"></i> List', array('class' => 'hide-menu')),
                                    array('controller' => 'contactsInquiries', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } ?>
                        </ul>
                    </li>

                <?php 
                }

                //for Banquets
                if(in_array(24, $moduleArr)){
                    $subArr = $subModuleArr[24];
                ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi  mdi-weather-pouring"></i>
                            <span class="hide-menu">Banquets</span>
                           
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">

                            <?php 
                            //list
                            if(in_array(46, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-format-list-bulleted"></i> List', array('class' => 'hide-menu')),
                                    array('controller' => 'banquets', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php }
                            //add
                            if(in_array(47, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-shape-square-plus"></i> Add', array('class' => 'hide-menu')),
                                    array('controller' => 'banquets', 'action' => 'add'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } ?>
                        </ul>
                    </li>

                <?php 
                }

                //for Activities
                if(in_array(25, $moduleArr)){
                    $subArr = $subModuleArr[25];
                ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi  mdi-weather-pouring"></i>
                            <span class="hide-menu">Activities</span>
                           
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">

                            <?php 
                            //list
                            if(in_array(48, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-format-list-bulleted"></i> List', array('class' => 'hide-menu')),
                                    array('controller' => 'activities', 'action' => 'index'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php }
                            //add
                            if(in_array(49, $subArr)){
                            ?>
                            <li class="sidebar-item">
                                <?php echo $this->Html->link(
                                    $this->Html->tag('span', '<i class="mdi mdi-shape-square-plus"></i> Add', array('class' => 'hide-menu')),
                                    array('controller' => 'activities', 'action' => 'add'),
                                    array('escape' => FALSE,'class'=>'sidebar-link')
                                ); ?>
                                
                            </li>
                            <?php } ?>
                        </ul>
                    </li>

                <?php 
                }
                ?>
                
                <li class="sidebar-item">
                     <?php echo $this->Html->link(
                                $this->Html->tag('span', '<i class="mdi mdi-directions"></i> Log Out', array('class' => 'hide-menu')),
                                array('controller' => 'admin', 'action' => 'logout'),
                                array('escape' => FALSE,'class'=>'sidebar-link waves-effect waves-dark sidebar-link')
                            ); ?>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>