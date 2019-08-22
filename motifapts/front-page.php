<?php 
/*
* Front Page template
*
*/
get_header(); ?>
<div id="home" class="container" role="main">
	<?php print_header_section(); ?>
	<?php print_content_section(); ?>
	<?php print_image_and_content_section(); ?>
	<?php list_section(); ?>
	<?php contact_section(); ?>
	<?php bottom_images(); ?>
</div>
<?php get_footer(); ?>