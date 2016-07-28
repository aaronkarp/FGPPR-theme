<?php
/**
 * Template Name: Contact
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
          <div class="subpageContentWide">
            <h2><?php if(get_field('displayTitle')) { the_field('displayTitle'); } else { the_title(); } ?></h2>
            <?php the_content(); ?>
            <?php
              if (get_field('location')) {
                $locations = get_field('location');
                $counter = 1;
                foreach ($locations as $location) { ?>
            <div class="locationBlock" id="block<?php echo $counter; ?>" style="background: transparent url('<?php echo $location['locationImage']; ?>') no-repeat top left;">
              <?php $counter++; ?>
              <h4><?php echo $location['locationName']; ?></h4>
              <?php echo $location['locationDetails']; ?>
            </div><!-- end .locationBlock -->
                <?php } ?>
            <div class="clearfix"></div>
              <?php } ?>
              <?php if (get_field('formText')) { the_field('formText'); } ?>
              <?php if (get_field('formShortcode')) { ?><div class="contactForm"><?php the_field('formShortcode'); ?></div><!-- end .contactForm --><?php } ?>
              <?php 
                if (get_field('socialMediaLink')) {
                  $socialMediaLinks = get_field('socialMediaLink'); ?>
                  <div class="socialLinks">
                  <h4><?php the_field('socialTitle'); ?></h4>
                  <?php foreach ($socialMediaLinks as $socialMediaLink) { ?>
                    <a href="<?php echo $socialMediaLink['socialMediaLink']; ?>" style="background: transparent url('<?php echo $socialMediaLink['socialMediaIcon']; ?>') no-repeat top left;" class="socialLink"><?php echo $socialMediaLink['socialMediaName']; ?></a>
                  <?php } ?>
                  <div class="clearfix"></div>
                <?php } ?>
          </div><!-- end .subpageContentWide -->
          <div class="clearfix"></div>
<?php endwhile; ?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>