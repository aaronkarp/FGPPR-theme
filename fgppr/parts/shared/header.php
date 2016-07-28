	<div class="container">
      <div class="header">
        <?php wp_nav_menu(array('container' => false, 'menu_class' => 'navbar')); ?>
      </div><!-- end .header -->
      <div class="mainBody">
        <div class="content">
          <?php if(is_front_page()) { ?>
          <h1><span class="visuallyhidden focusable">Foran Glennon Palandech Ponzi &amp; Rudloff</span></h1>
          <?php } else { ?>
          <h1 class="subPage"><span class="visuallyhidden focusable">Foran Glennon Palandech Ponzi &amp; Rudloff</span></h1>
          <?php } ?>
