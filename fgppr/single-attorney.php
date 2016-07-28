<?php
/**
 * The template for displaying attorney bios (html, print & vCard).
 */
?>
<?php 
if ($_GET) {
    $id = get_the_ID();
  if ($_GET['type'] == 'pdf') {
    $stylesheet = "";
    $html = "";
    $title = "bio.pdf";
    if (get_the_title($id)) {
      $theTitle = get_the_title($id);
      $intro = get_field('attorneyIntro', $id);
      $education = get_field('attorneyEducation', $id);
      $barAdmissions = get_field('attorneyBarAdmissions', $id);
      $proAssociations = get_field('attorneyProAssociations', $id);
      $publications = get_field('attorneyPublications', $id);
      $citedCases = get_field('attorneyCitedCases', $id);
      $email = get_field('attorneyEmail', $id);
      $phone = get_field('attorneyPhone', $id);
      $stylesheet = file_get_contents(TEMPLATEPATH . '/printbio.css');
      $html = '<div class="content">';
      $html .= '<div class="logo"><img src="/wp-content/themes/fgppr/images/header.png" /></div>';
      $html .= "<h2>" . $theTitle . "</h2>";
      $title = get_the_title($id) . ".pdf";
      if ($intro) {
        $html .= "<p>" . $intro . "</p>";
      }
      if ($education) {
        $html .= "<h3>Education</h3>";
        $html .= '<p>' . $education . '</p>';
      }
      if ($barAdmissions) {
        $html .= "<h3>Bar Admissions</h3>";
        $html .= '<p>' . $barAdmissions . '</p>';
      }
      if ($proAssociations) {
        $html .= "<h3>Professional Associations</h3>";
        $html .= '<p>' . $proAssociations . '</p>';
      }
      if ($publications) {
        $html .= "<h3>Publications</h3>";
        $html .= '<p>' . $publications . '</p>';
      }
      if ($citedCases) {
        $html .= "<h3>Cited Cases</h3>";
        $html .= '<p>' . $citedCases . '</p>';
      }
      if ($phone || $email) {
        $html .= '<div class="contact"><h3>Contact</h3><p>';
        if ($email) {
          $html .= $email . "<br />";
        }
        if ($phone) {
          $html .= $phone;
        }
        $html .= '</p></div></div>';
      }
      include(TEMPLATEPATH . '/mpdf/mpdf.php');
      $mpdf = new mPDF('utf-8','Letter');
      $mpdf->debug = true;
      $mpdf->WriteHTML($stylesheet,1);
      $mpdf->WriteHTML($html);
      $mpdf->Output($title,'I');
      exit;
    }
  } else if ($_GET['type'] == 'vcard') {
    header('Content-type: text/vcard');
    header('Content-Disposition: attachment; filename="' . get_the_title($id) . '.vcf"');
    echo "BEGIN:VCARD\n";
    echo "VERSION:2.1\n";
    echo "N:" . get_field('attorneyLastName', $id) . ";" . get_field('attorneyFirstName', $id) . "\n";
    echo "FN:" . get_the_title($id) . "\n";
    echo "ORG:Foran Glennon Palandech Ponzi & Rudloff\n";
    if (get_field('attorneyPhoto', $id)) {
      echo "PHOTO;VALUE=uri:" . get_field('attorneyPhoto', $id) . "\n";
    }
    if (get_field('attorneyPhone', $id)) {
      echo "TEL;WORK;VOICE:" . get_field('attorneyPhone', $id) . "\n";
    }
    if (get_field('attorneyEmail', $id)) {
      echo "EMAIL;PREF;INTERNET:" . get_field('attorneyEmail', $id) . "\n";
    }
    echo "URL:" . get_bloginfo('url') . "\n";
    echo "END:VCARD\n";
    exit;
  } else if ($_GET['type'] == 'qr') {
    include(TEMPLATEPATH . '/phpqrcode/qrlib.php');
    $qrContent .= "BEGIN:VCARD\n";
    $qrContent .= "VERSION:2.1\n";
    $qrContent .= "N:" . get_field('attorneyLastName', $id) . ";" . get_field('attorneyFirstName', $id) . "\n";
    $qrContent .= "FN:" . get_the_title($id) . "\n";
    $qrContent .= "ORG:Foran Glennon Palandech Ponzi & Rudloff\n";
    if (get_field('attorneyPhone', $id)) {
      $qrContent .= "TEL;WORK;VOICE:" . get_field('attorneyPhone', $id) . "\n";
    }
    if (get_field('attorneyEmail', $id)) {
      $qrContent .= "EMAIL;PREF;INTERNET:" . get_field('attorneyEmail', $id) . "\n";
    }
    $qrContent .= "URL:" . get_bloginfo('url') . "\n";
    $qrContent .= "END:VCARD\n";
    QRcode::png($qrContent);
    exit;
  }
} else { ?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
          <div class="subpageContent">
            <h2 class="attorneys">Attorneys</h2>
            <h3 class="attorneys"><?php the_title(); ?></h3>
            <?php if (get_field('attorneyIntro')) { ?>
            <p><?php the_field('attorneyIntro'); ?></p>
            <?php } ?>
            <div class="subColumn" id="left">
              <?php if (get_field('attorneyEducation')) { ?>
              <h4 class="attorneys">Education</h4>
              <div class="attorneySection"><?php the_field('attorneyEducation'); ?></div>
              <?php } ?>
              <?php if (get_field('attorneyBarAdmissions')) { ?>
              <h4 class="attorneys">Bar Admissions</h4>
              <div class="attorneySection"><?php the_field('attorneyBarAdmissions'); ?></div>
              <?php } ?>
              <?php if (get_field('attorneyProAssociations')) { ?>
              <h4 class="attorneys">Professional Associations</h4>
              <div class="attorneySection"><?php the_field('attorneyProAssociations'); ?></div>
              <?php } ?>
              <?php if (get_field('attorneyCitedCases')) { ?>
              <h4 class="attorneys">Cited Cases</h4>
              <div class="attorneySection"><?php the_field('attorneyCitedCases'); ?></div>
              <?php } ?>
            </div><!-- end .subColumn -->
            <div class="subColumn">
              <?php if (get_field('attorneyPublications')) { ?>
              <h4 class="attorneys">Publications</h4>
              <div class="attorneySection"><?php the_field('attorneyPublications'); ?></div>
              <?php } ?>
              <?php if (get_field('attorneyHonors')) { ?>
              <h4 class="attorneys">Honors</h4>
              <div class="attorneySection"><?php the_field('attorneyHonors'); ?></div>
              <?php } ?>
            </div><!-- end .subColumn -->
            <div class="clearfix"></div><!-- end .clearfix -->
          </div><!-- end .subpageContent -->
          <div class="subpageSidebar">
            <?php if (get_field('attorneyPhoto')) { ?>
            <img src="<?php the_field('attorneyPhoto'); ?>" border="0" />
            <?php } ?>
            <p class="attorneyInfo">
              <?php the_title(); ?><br />
              <?php if (get_field('attorneyEmail')) { echo '<a href="mailto:' . get_field('attorneyEmail') . '">' . get_field('attorneyEmail') . '</a><br />'; } ?>
              <?php if (get_field('attorneyPhone')) { echo get_field('attorneyPhone') . '<br />'; } ?>
              <a href="?type=pdf">Print Bio</a><br />
              <a href="?type=vcard">Download vCard</a>
              <?php if(is_user_logged_in()) { ?>
              <br /><a href="?type=qr">Get QR Code</a>
              <?php } ?>
            </p>
          </div><!-- end .subpageSidebar -->
<?php endwhile; ?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>
<?php } ?>