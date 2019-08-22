<?php

// This file holds the different custom functions.  Most of these functions refer to
// fields created with the ACF plugin, and will not work unless the fields have been defined.
// There is a .json file that is included with the respository that can be imported to create the fields.


// Header functions
function print_header_GTM_code(){
  if($gtm_id = get_field('gtm_id','options')) {
    echo $gtm_id;    
  }
}

function print_favicons(){
  if($icon = get_field('favicon','options')) {
    echo '<link rel="shortcut icon" href="/'.$icon['filename'].'"/>';
    echo '<link rel="shortcut icon" href="'.$icon['url'].'"/>';
  }
}

function print_logo(){
  if($logo = get_field('logo', 'options')) {
    echo '<div id="logo">';
 	  	echo '<a href="'.home_url('').'">';
        echo '<span class="icon-motif"></span>';
   			// echo '<img src="'.$logo['url'].'" />';
    	echo '</a>';
    echo '</div>';
  }
}

function print_trigger() {
  echo '<div id="nav-trigger" class="inactive ease">';
    echo '<div class="trigger-wrap">';
	    echo '<span class="line"></span>';
	    echo '<span class="line"></span>';
	    echo '<span class="line"></span>';
    echo '</div>';
  echo '</div>';
}

function print_social(){
  if ($rows = get_field('social_media_accounts','options')){
    echo '<div class="icons social">';
      foreach($rows as $row){
        echo '<a class="icon" href="'.$row['url'].'" target="_blank">';
       		echo '<i class="'.$row['account_type'].'"></i>';
        echo '</a>';
      }
    echo '</div>';
  }
}

function print_address() {
  $address = get_field('address','options');
  $city = get_field('city','options');
  $state = get_field('state','options');
  $zip = get_field('zip','options');
  if($address){
      echo '<div class="address">';
        echo '<a href="https://www.google.com/maps/place/'.$address.'+'.$city.'+'.$state.'+'.$zip.'" class="'.$class.'" target="_blank">';
          echo '<span class="line">'.$address.'</span><span class="break">, </span><span class="line">'.$city.', '.$state.' '.$zip.'</span></a>';
      echo '</div>';
    }
}

function print_phone_number(){
  if ($phone = get_field('phone','options')){
    echo '<div class="phone">';
      echo '<a href="tel:+1'.clean_phone($phone).'" class="phone-number ease">'.$phone.'</a>';
    echo '</div>';
  }
}

function print_privacy_policy() {
  if($privacy = get_field('privacy_policy', 'options')){
    echo '<div id="privacy"><a href="'.$privacy.'" target="_blank">Privacy Policy</a></div>';
  }
}


function print_image_grid($header) {
  $grid = $header['image_grid'];
  if($grid['first_small_image'] && $grid['second_small_image'] && $grid['large_image']) {
    echo '<div class="image-grid">';
      echo '<div class="small-images">';
        echo '<img src="'.$grid['first_small_image']['url'].'" alt="'.$grid['first_small_image']['alt'].'" />';
        echo '<img src="'.$grid['second_small_image']['url'].'" alt="'.$grid['second_small_image']['alt'].'" />';
      echo '</div>';
      echo '<div class="large-image"><img src="'.$grid['large_image']['url'].'" alt="'.$grid['large_image']['alt'].'" /></div>';
    echo '</div>';
  }
}

function print_feature_image($header) {
  $feature_image = $header['feature_image'];
  if($feature_image['featured_image']) {
    echo '<div class="featured-image">';
      echo '<img class="featured" src="'.$feature_image['featured_image']['url'].'" alt="'.$feature_image['featured_image']['url'].'"/>';
      echo '<span class="icon-motif-logo"></span>';
      // echo '<img class="logo" src="'.get_bloginfo('template_url').'/images/motif-logo.png" alt="Motif Logo"/>';
      echo '<div class="tagline-container">';
        if($feature_image['tagline']) { echo '<div class="tagline">'.$feature_image['tagline'].'</div>'; }
        echo '<div class="mobile-leasing">Leasing this fall</div>';
      echo '</div>';
    echo '</div>';
  }
}

function print_header_section() {
  $header = get_field('header_area');
  echo '<section class="header-area wrapper">';
    print_image_grid($header);
    print_feature_image($header);
  echo '</section>';
}


function print_content_section() {
  $content = get_field('content_area');
  echo '<section class="content-area wrapper">';
    echo '<div class="headline"><h2 class="title">'.$content['headline_h2'].'</h2></div>';
    echo '<div class="copy">';
      echo $content['copy'];
      echo '<div class="arrival-date">';
        echo '<div class="time">Fall 2019</div>';
        echo '<div class="locale">Fort Lauderdale</div>';
      echo '</div>';
    echo '</div>';
  echo '</section>';
}

function print_image_row($images) {
  $img_row = $images['image_row'];
  if($img_row['large_image'] && $img_row['first_small_image'] && $img_row['second_small_image'] && $img_row['third_small_image']) {
    echo '<div class="image-row">';
      echo '<div class="lrg-img-container">';
        echo '<img src="'.$img_row['large_image']['url'].'" alt="'.$img_row['large_image']['alt'].'" />';
      echo '</div>';
      echo '<div class="sm-images-container">';      
        echo '<div class="img-wrap"><img src="'.$img_row['first_small_image']['url'].'" alt="'.$img_row['first_small_image']['alt'].'" /></div>';
        echo '<div class="img-wrap"><img src="'.$img_row['second_small_image']['url'].'" alt="'.$img_row['second_small_image']['alt'].'" /></div>';
        echo '<div class="img-wrap"><img src="'.$img_row['third_small_image']['url'].'" alt="'.$img_row['third_small_image']['alt'].'" /></div>';
      echo '</div>';
    echo '</div>';
  }
}

function print_content_row($content) {
  $content_row = $content['content_row'];
  if($content_row['headline_h3'] && $content_row['large_image']) {
    echo '<div class="content-row">';
      echo '<div class="content-wrapper">';
        echo '<h3 class="headline">'.$content_row['headline_h3'].'</h3>';
      echo '</div>';
      echo '<div class="image-container">';
        echo '<img src="'.$content_row['large_image']['url'].'" alt="'.$content_row['large_image']['alt'].'" />';
      echo '</div>';
    echo '</div>';
  }
}
 
function print_image_and_content_section() {
  $img_and_content = get_field('image_and_content_area');
  echo '<section class="image-and-content-area wrapper">';
    print_image_row($img_and_content);
    print_content_row($img_and_content);
  echo '</section>';
}

function list_section() {
  $lists = get_field('list_area');
  if($lists) {
    echo '<section class="list-area">';
      echo '<a name="features-amenities" id="features-amenities"></a>';
      echo '<div class="green-bg"></div>';
      echo '<div class="black-bg"></div>';
      echo '<div class="list-container wrapper">';
        echo '<div class="title-wrapper">';
          echo '<h3 class="headline">'.$lists['headline_h3'].'</h3>';
        echo '</div>';
        if($lists['lists']){
          echo '<div class="lists-wrapper">';
          foreach ($lists['lists'] as $list) {
            echo '<div class="single-list">';
              echo '<div class="list-title">'.$list['title'].'</div>';
              if($list['list']) {
                echo '<ul class="list">';
                  foreach ($list['list'] as $list_item) {
                    echo '<li>'.$list_item['list_item'].'</li>';
                  }
                echo '</ul>';
              }
            echo '</div>';
          }
          echo '</div>';
        }
      echo '</div>';
    echo '</section>';
  }
}

function contact_section() {
  $contact = get_field('contact_form_area');
  echo '<section class="contact-area wrapper">';
    echo '<a name="contact-area" id="contact-area"></a>';
    echo '<div class="border"></div>';
    echo '<div class="content-wrapper">';
      echo '<h3 class="headline">'.$contact['headline_h3'].'</h3>';
      echo '<div class="copy">'.$contact['copy'].'</div>';
    echo '</div>';
    echo '<div class="form-wrapper">';
      echo FrmFormsController::get_form_shortcode( array( 'id' => 1, 'title' => false, 'description' => false ) );
    echo '</div>';
    echo '<div class="border"></div>';
  echo '</section>';
}

function bottom_images() {
  $bottom_images = get_field('bottom_image_area');
  echo '<section class="bottom-image-area wrapper">';
    print_image_row($bottom_images);
  echo '</section>';
}

function sub_footer_elements() {
  echo '<section class="subfooter wrapper">';
    // echo '<a href="#top" class="jump"><div class="logo"></div></a>'
    echo '<a href="#top" class="jump"><span class="icon-motif-logo"></span></a>';
    print_address();
  echo '</section>';
}

function footer_elements() {
  echo '<div class="footer-inner wrapper">';
    echo '<div class="management-logo">';
      echo '<img src="'.get_bloginfo('template_url').'/images/management.png" alt="Bell Apartment Investement & Management" />';
    echo '</div>';
    echo '<div class="social-media">';
      print_social();
    echo '</div>';
    echo '<div class="eho">';
      echo '<span class="icon-handi"></span><span class="icon-eho"></span>';
      // echo '<img src="'.get_bloginfo('template_url').'/images/eholockup.png" alt="Handicap Accessible and Equal Housing Opportunity" />';
    echo '</div>';
  echo '</div>';

}

?>