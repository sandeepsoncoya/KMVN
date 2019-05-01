<?php if(isset($siteSettings['SiteSettings']['home_content']) && $siteSettings['SiteSettings']['home_content']!=""): ?>
<section class="amp-block ampb-bg-gray">
    <div class="container">
        <div class="ampb-head">
            <h2 class="ampb-title">Welcome to Amaze</h2>
        </div>
        <div class="ampb-content ampb-about text-center">
           <?php echo $siteSettings['SiteSettings']['home_content']; ?>
        </div>
    </div>
</section>
<?php endif; ?>