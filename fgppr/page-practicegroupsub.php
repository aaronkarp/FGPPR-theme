<?php
/**
 * Template Name: Practice Groups Sub
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post();
  global $post;
  $parents = get_post_ancestors($post->ID);
?>

          <div class="subpageContent">
            <?php if ($parents[0] != 21) { ?>
              <h2><a href="<?php echo get_permalink($parents[0]); ?>"><?php echo get_the_title($parents[0]); ?></a></h2>
              <h3><?php if(get_field('displayTitle')) { the_field('displayTitle'); } else { the_title(); } ?></h3>
            <?php } else { ?>
              <h2><?php if(get_field('displayTitle')) { the_field('displayTitle'); } else { the_title(); } ?></h2>
            <?php } ?>
            <?php the_content(); ?>
            <div>
              <?php
                $args = array(
                          'post_parent' => $id,
                          'post_type' => 'page',
                          'order' => 'ASC'
                        );
                $children = get_children($args);
                if (count($children) > 0) {
              ?>
              <ul class="childrenMenu">
                <?php 
                  foreach ($children as $child) { 
                    $childID = $child->ID;
                ?>
                <li>
                  <h4><a href="<?php echo get_permalink($childID); ?>"><?php echo $child->post_title; ?></a></h4>
                </li>
                  <?php }?>
              </ul>
              <?php } ?>
            </div>
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