<?php
/**
 * Template Name: News Archive
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>
<?php
  $sidebarImage;
  $imageLink;
  $calloutHeader;
  $calloutBody;
  $imageCaption;
  $captionLink;
  $addBorder;
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post();
  $sidebarImage = get_field('sidebarImage');
  $imageLink = get_field('imageLink');
  $calloutHeader = get_field('calloutHeader');
  $calloutBody = get_field('calloutBody');
  $imageCaption = get_field('imageCaption');
  $captionLink = get_field('captionLink');
  $addBorder = get_field('addBorder');
?>
          <div class="subpageContent">
            <h2><?php if(get_field('displayTitle')) { the_field('displayTitle'); } else { the_title(); } ?></h2>
            <?php the_content(); ?>
<?php endwhile; ?>
<?php 
  $counter = 0;
  $currentYear = date('Y');
  $currentPostYear = $currentYear;
  $previousPostYear = $currentPostYear;
?>
<?php query_posts(array('post_type' => 'news', 'orderby' => 'date', 'order' => 'DESC')); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post();
  $currentPostYear = get_the_date('Y');
  if($currentPostYear != $previousPostYear) { ?>
      </div><!-- end .newsSection -->
<?php
    $counter = 0;
  }
  if ($counter < 1) { ?>
    <div class="newsSection <?php if (($currentYear - $currentPostYear) % 2 == 0) { echo 'odd'; } else { echo 'even'; } ?>">
      <h4><?php echo $currentPostYear; ?></h4>
<?php
  }
  the_content();
  $previousPostYear = get_the_date('Y');
  $counter++;
?>
<?php endwhile; ?>
            </div><!-- end .newsSection -->
          </div><!-- end .subpageContent -->
          <div class="subpageSidebar">
            <?php
              if ($sidebarImage) {
                if ($imageLink) { ?>
                  <a href="<?php echo $imageLink; ?>"><img src="<?php echo $sidebarImage; ?>" <?php if ($calloutHeader || $calloutBody || $imageCaption || ($addBorder == 'false')) { ?>style="border-bottom: none;" <?php } ?>border="0" /></a>
                <?php } else { ?>
                  <img src="<?php echo $sidebarImage; ?>" <?php if ($calloutHeader || $calloutBody || $imageCaption || ($addBorder == 'false')) { ?>style="border-bottom: none;" <?php } ?>border="0" />
                <?php } ?>
                <?php if ($imageCaption) { ?>
                  <span class="imageCaption">
                  <?php if ($captionLink) { ?>
                    <a href="<?php echo $captionLink; ?>"><?php echo $imageCaption; ?></a>
                  <?php } else { ?>
                    <?php echo $imageCaption; ?>
                  <?php } ?>
                  </span>
                <?php } ?>
              <?php } ?>
              <?php if ($calloutHeader || $calloutBody) { ?>
                <div class="sidebarCallout">
                  <?php if ($calloutHeader) { ?>
                  <h3><?php echo $calloutHeader; ?></h3>
                  <?php } ?>
                  <?php if ($calloutBody) {
                    echo $calloutBody;
                  } ?>
                </div>
              <?php } ?>
          </div><!-- end .subpageSidebar -->

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>