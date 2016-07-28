<?php
/**
 * Template Name: Home
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php the_content(); ?>
          <div class="homeCallout" id="firmNews">
            <h3>Firm News</h3>
            <div class="calloutBody">
<?php
  $newsQuery = new WP_Query(array('post_type' => 'news', 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => 2));
  if ($newsQuery->have_posts()) { ?>
    <ul>
<?php
    $counter = 0;
    while ($newsQuery->have_posts()) : $newsQuery->the_post(); ?>
    <li><?php the_field('excerpt'); ?></li>
<?php
    endwhile;
?>
    </ul>
    <a href="<?php echo get_permalink('23'); ?>" class="moreLink">Click here for more</a>
<?php
    wp_reset_postdata();
  }
?>
            </div><!-- end .calloutBody -->
          </div><!-- end .homeCallout -->
<?php if (get_field('aboutTheFirm')) { ?>
          <div class="homeCallout" id="aboutTheFirm">
            <h3>About the Firm</h3>
            <div class="calloutBody">
<?php echo get_field('aboutTheFirm'); ?>
            </div><!-- end .calloutBody -->
          </div><!-- end .homeCallout -->
<?php } ?>
<?php if (get_field('socialMediaLink')) { ?>
          <div class="homeCallout" id="socialMedia">
            <h3>Social Media</h3>
            <div class="calloutBody">
<?php $socialMediaLinks = get_field('socialMediaLink'); ?>
<?php foreach($socialMediaLinks as $socialMediaLink) { ?>
              <p>
                <a href="<?php echo $socialMediaLink['socialMediaURL']; ?>"><b><?php echo $socialMediaLink['socialMediaService']; ?></b></a>
              </p>
<?php } ?>
            </div><!-- end .calloutBody -->
          </div><!-- end .homeCallout -->
<?php } ?>
<?php if (get_field('publications')) { ?>
          <div class="homeCallout" id="publications">
            <h3>Publications</h3>
            <div class="calloutBody">
<?php echo get_field('publications'); ?>
            </div><!-- end .calloutBody -->
          </div><!-- end .homeCallout -->
<?php } ?>
<?php endwhile; ?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>