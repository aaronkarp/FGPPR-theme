<?php
/**
 * The template for displaying all pages.
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
          <div class="subpageContent">
            <h2><?php if(get_field('displayTitle')) { the_field('displayTitle'); } else { the_title(); } ?></h2>
            <?php the_content(); ?>
          </div><!-- end .subpageContent -->
          <div class="subpageSidebar">
            <?php
              if (get_field('sidebarImage')) {
                if (get_field('imageLink')) { ?>
                  <a href="<?php the_field('imageLink'); ?>"><img src="<?php the_field('sidebarImage'); ?>" <?php if (get_field('calloutHeader') || get_field('calloutBody') || get_field('imageCaption') || get_field('addBorder') == 'false') { ?>style="border-bottom: none;" <?php } ?>border="0" /></a>
                <?php } else { ?>
                  <img src="<?php the_field('sidebarImage'); ?>" <?php if (get_field('calloutHeader') || get_field('calloutBody') || get_field('imageCaption') || get_field('addBorder') == 'false') { ?>style="border-bottom: none;" <?php } ?>border="0" />
                <?php } ?>
                <?php if (get_field('imageCaption')) { ?>
                  <span class="imageCaption">
                  <?php if (get_field('captionLink')) { ?>
                    <a href="<?php the_field('captionLink'); ?>"><?php the_field('imageCaption'); ?></a>
                  <?php } else { ?>
                    <?php the_field('imageCaption'); ?>
                  <?php } ?>
                  </span>
                <?php } ?>
              <?php } ?>
              <?php if (get_field('calloutHeader') || get_field('calloutBody')) { ?>
                <div class="sidebarCallout">
                  <?php if (get_field('calloutHeader')) { ?>
                  <h3><?php the_field('calloutHeader'); ?></h3>
                  <?php } ?>
                  <?php if (get_field('calloutBody')) {
                    the_field('calloutBody');
                  } ?>
                </div>
              <?php } ?>
          </div><!-- end .subpageSidebar -->
<?php endwhile; ?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>