 <section class="kh-banner" style="background-image:url('<?php echo Configure::read('siteUrlfront');  ?>/uploads/SiteSettings/<?php  echo $siteSettings['SiteSettings']['package_inner_banner'] ?>');">
        <div class="khb-in">
            <div class="container">
                <h2><?php  if ($slug == 'about') { echo 'About';}else{ echo $data['Cms']['title'];} ?></h2>
                <ul class="breadcrumb">
                    <li><?php echo $this->Html->link('Home','/pages/home'); ?></li>
                    <li><span><?php if ($slug == 'about') { echo 'About';}else{ echo $data['Cms']['title'];} ?></span></li>
                </ul>
            </div>
        </div>
</section>
<?php if ($slug == 'about') { 
        if (!empty($data)) {
            foreach ($data as $key => $section) {
                if ($section['Cms']['title'] == 'Welcome to Kumaon') {
                     $bg = 'bg-map';
                }elseif($section['Cms']['title'] == 'About Kmvn'){
                    $bg = 'bg-pink';
                }else{
                    $bg = '';
                }
    ?>
    <section class="kmab-block bg-black <?= $bg; ?>">
        <div class="container">
            <div class="kmab-head">
                <h2><?= $section['Cms']['title'] ?></h2>
            </div>
            <div class="kmab-content">
                <?= $section['Cms']['description'] ?>
            </div>
        </div>
    </section>
    <?php  } } ?>
  
<?php }else{ ?>

    <section class="khp-block">
        <div class="container">
            <div class="khpb-content">
               <?= $data['Cms']['description'] ?>
            </div>
        </div>
    </section>

    <?php } ?>