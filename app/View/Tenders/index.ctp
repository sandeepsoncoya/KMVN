<section class="kh-banner" style="background-image:url('<?php echo Configure::read('siteUrlfront');  ?>/uploads/SiteSettings/<?php  echo $siteSettings['SiteSettings']['destination_inner_banner'] ?>');">
        <div class="khb-in">
            <div class="container">
                <h2>Tenders</h2>
                <ul class="breadcrumb">
                    <li><?php echo $this->Html->link('Home','/pages/home'); ?></li>
                    <li><span>Tenders</span></li>
                </ul>
            </div>
        </div>
    </section>
    <section class="khp-block">
        <div class="container">
            <div class="khpb-content">
                <div class="row">
                    <div class="col-md-3 col-sm-4 menu">
                        <ul class="kmtn-link">
                            <li><a href="javascript:;" onclick="getTenders(0)" class="active">All</a></li>

                            <?php if(!empty($tenders)): ?>
                            <?php foreach ($tenders as $key => $tendercat) :
                            ?>
                            <li><a class="" href="javascript:;" onclick="getTenders('<?php echo $tendercat['TenderCategory']['id']; ?>')" ><?php echo $tendercat['TenderCategory']['name']; ?></a></li>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="col-md-9 col-sm-8 loading">
                        <?php if(!empty($tenders)){ ?>
                            <?php foreach ($tenders as $key => $tender) {
                                if (!empty($tender['Tenders']['name'])) {
                                $fileAbsolutePathFeatured = Configure::read('AbsoluteUrl').'tenders/'.$tender['Tenders']['file'];
                           
                            ?>
                        <div class="kmtndr-item">
                            <p><?php echo $tender['Tenders']['name']; ?></p>
                            <a href="<?php echo $fileAbsolutePathFeatured ?>" target="_blank" class="btn btn-pink" download>Download</a>
                        </div>
                        <?php  } ?>
                        <?php } ?>
                            <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

     <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <script type="text/javascript">
    // Load more data
   function getTenders(catid){
            $('li a.active').removeClass('active');
             $target = $(event.target); 
             $target.addClass('active');
    $.ajax({
                url: siteUrlfront+'ajax/getTenders',
                type: 'post',
                data: {catid:catid},
                beforeSend:function(){
                    $(".loading").html("<i class='fas fa-spinner fa-spin'></i> Loading content...");
                },
                success: function(response){
                   $(".loading").html(response);
                }
            });
    }
    </script>