<!DOCTYPE html>
<html>
	<head>
	  <title><?php wp_title(''); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php print_favicons(); ?>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','<?php echo print_header_GTM_code();?>');</script>
    <!-- End Google Tag Manager -->
	  <?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo print_header_GTM_code();?>"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <a name="top" id="top"></a>
      <header id="header">
        <div class="header-inner wrapper">
          <div id="logo-container">
            <?php print_logo() ;?>
            <div class="leasing">Leasing this fall</div>
          </div>
          <div id="navigation-container">
            <div class="skip">skip down to</div>
            <nav id="navigation"><?php wp_nav_menu( array( 'container' => '', 'theme_location' => 'main_menu') ); ?></nav>
          </div>
        </div>
      </header>
