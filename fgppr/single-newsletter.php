<?php
/**
 * The template for displaying newsletters.
 */
?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php
  $oid = 0;
  if ($_GET['oid']) {
    $oid = $_GET['oid'];
  }
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
          <div class="subpageContentWide">
            <h2><?php the_title(); ?></h2>
            <ul class="newsletterList">
              <?php
                if (get_field('article')) {
                  $articles = get_field('article');
                  $i = 0;
                  foreach ($articles as $article) {
                    if ($i == $oid) {
                      $li = '<li class="currentArticle">';
                    } else {
                      $li = '<li>';
                    }
                    echo $li . '<a href="?oid=' . $i . '">'. $article['articleTitle'] . '</a>';
                    $i++;
                  }
                }
              ?>
              <li class="newsletterBackLink"><a href="<?php echo get_permalink(24); ?>">Back to Publications</a></li>
            </ul>
            <div class="articleContent">
              <h3><?php echo $articles[$oid]['articleTitle']; ?></h3>
              <?php echo $articles[$oid]['articleBody']; ?>
            </div><!-- end .articleContent -->
          </div><!-- end .subpageContentWide -->
<?php endwhile; ?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>