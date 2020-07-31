<?php
session_start();
if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    //add_image_size ( string $name, int $width, int $height, bool|array $crop = false )
    add_theme_support('post-thumbnails');    
    add_image_size( 'sidebar-thumb', 60, 30, true );
    add_image_size( 'home-thumb', 600, 380, true );
    add_image_size( 'home-large-thumb', 555, 650, true );
    add_image_size( 'banner', 1150, 300, true );
    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

// Enable the use of shortcodes in text widgets.
add_filter( 'widget_text', 'do_shortcode' );

//HỦY CROP ẢNH NHIỀU SIZE
function remove_unused_image_size( $sizes) {
unset( $sizes['thumbnail']);
unset( $sizes['medium']);
unset( $sizes['large']);
//unset( $sizes['post-thumbnail']);
return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'remove_unused_image_size');

register_nav_menus(
	array( 'main-menu' => __( 'Main Menu', 'dangky3g4g' ) )
);
register_nav_menus(
	array( 'left-menu' => __( 'Left Menu', 'dangky3g4g' ) )
);
register_nav_menus(
	array( 'footer-menu' => __( 'footer Menu', 'dangky3g4g' ) )
);

function product_price($priceFloat) {
	$symbol = ' đ';
	$symbol_thousand = '.';
	$decimal_place = 0;
	$price = number_format($priceFloat, $decimal_place, '', $symbol_thousand);
	return $price;
}


function khuyen_mai($value){
	switch ($value) {
		case '1':
			return 'Tặng khung tranh';
			break;
		case '2':
			return 'Tặng phí lắp đặt';
			break;
		default:
			return '';
			break;
	}
}

function phantrang($current_page, $count, $num_in_page){
	$html = '';
	$so_trang = ceil($count / $num_in_page);
	for ($i=1; $i <= $so_trang; $i++) { 
		$html .= '<a href="page/'.$i.'">'.$i.'</a>';
	}
	return $html;
}


function page_nav() {
  
  if( is_singular() )
    return;
  
  global $wp_query;
  
  /** Stop execution if there's only 1 page */
  if( $wp_query->max_num_pages <= 1 ) return; $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1; $max = intval( $wp_query->max_num_pages );
  
  /** Add current page to the array */
  if ( $paged >= 1 )
    $links[] = $paged;
  
  /** Add the pages around the current page to the array */
  if ( $paged >= 3 ) {
    $links[] = $paged - 1;
    $links[] = $paged - 2;
  }
  
  if ( ( $paged + 2 ) <= $max ) {
    $links[] = $paged + 2;
    $links[] = $paged + 1;
  }
  
  echo '
<div class="navigation">
<ul>' . "\n";
  
  /** Previous Post Link */
  if ( get_previous_posts_link() )
    printf( '
<li>%s</li>
 
' . "\n", get_previous_posts_link('<< Trước') );
  
  /** Link to first page, plus ellipses if necessary */
  if ( ! in_array( 1, $links ) ) {
    $class = 1 == $paged ? ' class="active"' : '';
  
    printf( '<li%s><a href="%s">%s</a></li>
 
' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
  
    if ( ! in_array( 2, $links ) )
      echo '
<li>…</li>
 
';
  }
  
  /** Link to current page, plus 2 pages in either direction if necessary */
  sort( $links );
  foreach ( (array) $links as $link ) {
    $class = $paged == $link ? ' class="active"' : '';
    printf( '<li%s><a href="%s">%s</a></li>
 
' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
  }
  
  /** Link to last page, plus ellipses if necessary */
  if ( ! in_array( $max, $links ) ) {
    if ( ! in_array( $max - 1, $links ) )
      echo '
<li>…</li>
 
' . "\n";
  
    $class = $paged == $max ? ' class="active"' : '';
    printf( '<li%s><a href="%s">%s</a></li>
 
' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
  }
  
  /** Next Post Link */
  if ( get_next_posts_link() )
    printf( '
<li>%s</li>
 
' . "\n", get_next_posts_link('Sau >>') );
  
  echo '</ul>
</div>
 
' . "\n";
  
}

include('mobile_detect.php');
function render_btn_dangky($cuphap, $dau_so){
  $detect = new Mobile_Detect();
  if($detect->is('iOS')){
  echo '<a href="sms:'.$dau_so.'&amp;body='.$cuphap.'" class="btn btn-primary register_sms" cuphap = "'.$cuphap.'" dau_so = "'.$dau_so.'">
    <b>Đăng ký</b>
  </a>&nbsp;';
  }else{
  echo '<a href="sms:'.$dau_so.'?body='.$cuphap.'" class="btn btn-primary register_sms" style="width: 100px;" cuphap = "'.$cuphap.'" dau_so = "'.$dau_so.'">
    <b>Đăng ký</b>
  </a>';
  }
}
add_filter('wpseo_robots', 'yoast_no_home_noindex', 999);
function yoast_no_home_noindex($string= "") {

  if(is_attachment()){
    $string= "noindex,nofollow";
    return $string;
  }else{
    $string= "index,follow";
    return $string;
  }
    
}


function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//Dòng này để chắc chắc WordPress sẽ đếm chính xác hơn
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function wpb_get_post_views($postID){
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return 0;
    }
    return $count;
}