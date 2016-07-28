<?php
/**
 * The archive page for listing all attorneys.
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

          <div class="subpageContent">
            <?php
              $parentPost = get_post(22);
              global $post;
            ?>
            <h2><?php echo $parentPost->post_title; ?></h2>
            <?php
              function my_fuzzy_word_length(){
                return 2;
              }
              add_filter( 'searchwp_fuzzy_min_length', 'my_fuzzy_word_length' );
              
              function my_fuzzy_threshold()
              {
                return 60;
              }
              add_filter( 'searchwp_fuzzy_threshold', 'my_fuzzy_threshold' );

              $content = $parentPost->post_content;
              $content = apply_filters('the_content', $content);
              if (!$_GET) {
                echo $content;
              } else {
                if (!$_GET['view']) {
                  if (class_exists('SearchWP')) {
                    $firstName = $wpdb->escape($_GET['firstName']) . " ";
                    $lastName = $wpdb->escape($_GET['lastName']);
                    $searchTerm = $firstName . $lastName;
                    $engine = SearchWP::instance();
                    $supplementalSearchEngineName = 'attorneysearch';
                    $posts = $engine->search('attorneysearch', $searchTerm);
                    
                    if (!empty($posts)) {
                      echo '<div class="attorneyHeader"><div class="attorneyName">Name</div><div class="attorneyPhone">Phone</div><div class="attorneyEmail">Email</div></div>';
                      foreach ($posts as $post) : setup_postdata($post);
                        echo '<div class="attorneyListing"><div><a href="' . get_permalink() . '" class="attorneyName">' . get_the_title() . '</a></div><div class="phoneNumber">' . get_field('attorneyPhone') . '&nbsp;</div><div><a href="mailto:' . get_field('attorneyEmail') . '" class="attorneyEmail"> ' . get_field('attorneyEmail') . '</a>&nbsp;</div></div>';
                        echo '<div class="clearfix"></div>';
                      endforeach;
                    } else {
                      echo "<p>Your search returned no results.</p>";
                    }
                  }
                } else {
                  $viewArgs = array(
                    'post_type' => 'attorney',
                    'orderby' => 'meta_value',
                    'meta_key' => 'attorneyLastName',
                    'order' => 'ASC',
                    'posts_per_page' => -1
                  );
                  $listQuery = new WP_Query($viewArgs);
                  if ($listQuery->have_posts()) {
                    while ($listQuery->have_posts()) {
                      $listQuery->the_post();
                      if ($_GET['view'] != 'all') {
                        if ($_GET['view'] == strtolower(substr(get_field('attorneyLastName'),0,1))) {
                          echo '<div class="attorneyListing"><div><a href="' . get_permalink() . '" class="attorneyName">' . get_the_title() . '</a></div><div class="phoneNumber">' . get_field('attorneyPhone') . '&nbsp;</div><div><a href="mailto:' . get_field('attorneyEmail') . '" class="attorneyEmail"> ' . get_field('attorneyEmail') . '</a>&nbsp;</div></div>';
                          echo '<div class="clearfix"></div>';
                        }
                      } else {
                        echo '<div class="attorneyListing"><div><a href="' . get_permalink() . '" class="attorneyName">' . get_the_title() . '</a></div><div class="phoneNumber">' . get_field('attorneyPhone') . '&nbsp;</div><div><a href="mailto:' . get_field('attorneyEmail') . '" class="attorneyEmail"> ' . get_field('attorneyEmail') . '</a>&nbsp;</div></div>';
                        echo '<div class="clearfix"></div>';
                      }
                    }
                  }
                }
              }
            ?>
          </div><!-- end .subpageContent -->
          <div class="subpageSidebar">
<?php
// Assemble a list of attorneys to determine which letters should be links in the alphabetical list
$attorneys = array(
   'a' => array(),
   'b' => array(),
   'c' => array(),
   'd' => array(),
   'e' => array(),
   'f' => array(),
   'g' => array(),
   'h' => array(),
   'i' => array(),
   'j' => array(),
   'k' => array(),
   'l' => array(),
   'm' => array(),
   'n' => array(),
   'o' => array(),
   'p' => array(),
   'q' => array(),
   'r' => array(),
   's' => array(),
   't' => array(),
   'u' => array(),
   'v' => array(),
   'w' => array(),
   'x' => array(),
   'y' => array(),
   'z' => array()
);
$args = array(
  'post_type' => 'attorney',
  'orderby' => 'meta_value',
  'meta_key' => 'attorneyLastName',
  'order' => 'ASC',
  'posts_per_page' => -1
);
$attorneyQuery = new WP_Query($args);
if ($attorneyQuery->have_posts()) {
  while ($attorneyQuery->have_posts()) {
    $letter = strtolower(substr(get_field('attorneyLastName'), 0, 1));
    $attorneys[$letter][] = $attorneyQuery->the_post();
  }
}
?>
            <form class="attorneySearch" method="GET">
              <h4>Attorney Search</h4>
              <label for="firstName">First Name</label><input type="text" name="firstName" id="firstName" />
              <div class="andOr">and/or</div>
              <label for="lastName">Last Name</label><input type="text" name="lastName" id="lastName" />
              <input type="hidden" name="" id="" value="" />
              <input type="submit" value="Search" />
<?php
  
?>
              <div>Click a letter below to list attorneys by last name.</div>
            <ul class="alphaList">
<?php
  foreach ($attorneys as $attorneyKey => $attorneyValue) {
    if (count($attorneys[$attorneyKey]) > 0) {
      echo '<li><a href="?view=' . $attorneyKey . '">' . strtoupper($attorneyKey) . '</a></li>';
    } else {
      echo '<li>' . strtoupper($attorneyKey) . '</li>';
    }
  }
?>
            </ul>
            <p class="viewAll"><a href="?view=all">View all</a></p>
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

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>