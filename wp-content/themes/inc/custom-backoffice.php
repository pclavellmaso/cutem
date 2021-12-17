<?php
/**
 * Custom Back-Office
 *
 * @package santa_cole
 */

 /* ------------- Custom Editor W */



 function my_mce_buttons_3( $buttons ) {	
	$buttons[] = 'fontsizeselect';
	$buttons[] = 'alignnone';
	$buttons[] = 'alignjustify';
	$buttons[] = 'selectall';
	//$buttons[] = 'code';
	$buttons[] = 'fontselect';
	$buttons[] = 'lineheight';
	//$buttons[] = 'lineheight';
	return $buttons;
}
add_filter( 'mce_buttons_3', 'my_mce_buttons_3' ); 


/* ------------- Custom Admin Menu for Authors */

add_action( 'admin_menu', 'remove_menus_author' );
function remove_menus_author() {

	$author = wp_get_current_user();

  if( isset( $author->roles[0] ) ) {
      $current_role = $author->roles[0];
  } else {
      $current_role = 'no_role';
  }

	if( 'author' == $current_role ) {
		remove_menu_page( 'index.php');
		remove_menu_page( 'edit.php' );          						// Posts
	  remove_menu_page( 'upload.php' );        						// Media
	  remove_menu_page( 'tools.php' );         						// Tools
	  remove_menu_page( 'edit-comments.php' ); 						// Comments
		remove_menu_page( 'edit.php?post_type=country' );		// Country
		remove_menu_page( 'edit.php?post_type=state' );			// State
		remove_menu_page( 'edit.php?post_type=city' );			// City
		remove_menu_page( 'profile.php' );									// Profile
		remove_menu_page( 'wpcf7' ); 												// Contact Form 7
		remove_menu_page( 'post-new.php');
		remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker');
		remove_submenu_page( 'edit.php?post_type=teacherfile','post-new.php?post_type=teacherfile' );

	}

}

/* ------------- Remove Admin Bar */

function remove_admin_bar( $show_admin_bar ) {
	return false;
}
add_filter( 'show_admin_bar' , 'remove_admin_bar' );

/* ------------- Customize Admin Style */
function custom_admin_ui() { ?>
	<style type="text/css">
		.nojq, #adminmenuback, #adminmenu li.current a.menu-top {
			background:#232F3D !important;
		}
		#adminmenuback, #adminmenuwrap, #adminmenu {
			background:#232F3D !important;
			border-right:1px solid #ccc;
		}
		#collapse-button:hover {
			color:#666 !important;
		}
		#wpadminbar .ab-top-menu > li.hover > .ab-item, #wpadminbar.nojq .quicklinks .ab-top-menu > li > .ab-item:focus, #wpadminbar:not(.mobile) .ab-top-menu > li:hover > .ab-item, #wpadminbar:not(.mobile) .ab-top-menu > li > .ab-item:focus {
			color:#bbb !important;
			background:transparent !important;
		}
		#wpadminbar .quicklinks .ab-sub-wrapper .menupop.hover > a, #wpadminbar .quicklinks .menupop ul li a:focus, #wpadminbar .quicklinks .menupop ul li a:focus strong, #wpadminbar .quicklinks .menupop ul li a:hover, #wpadminbar .quicklinks .menupop ul li a:hover strong, #wpadminbar .quicklinks .menupop.hover ul li a:focus, #wpadminbar .quicklinks .menupop.hover ul li a:hover, #wpadminbar .quicklinks .menupop.hover ul li div[tabindex]:focus, #wpadminbar .quicklinks .menupop.hover ul li div[tabindex]:hover, #wpadminbar li #adminbarsearch.adminbar-focused::before, #wpadminbar li .ab-item:focus .ab-icon::before, #wpadminbar li .ab-item:focus::before, #wpadminbar li a:focus .ab-icon::before, #wpadminbar li.hover .ab-icon::before, #wpadminbar li.hover .ab-item::before, #wpadminbar li:hover #adminbarsearch::before, #wpadminbar li:hover .ab-icon::before, #wpadminbar li:hover .ab-item::before, #wpadminbar.nojs .quicklinks .menupop:hover ul li a:focus, #wpadminbar.nojs .quicklinks .menupop:hover ul li a:hover {
			color:#bbb !important;
		}
		#wp-admin-bar-wp-custom-logout {
			float:right !important;
		}
		.woocommerce-page #wpcontent {
			padding:1px !important;
		}
	</style>
 <?php }
add_action( 'admin_enqueue_scripts', 'custom_admin_ui' );

/* ------------- Customize WP Admin Bar */
add_action( 'admin_bar_menu', 'custom_wp_admin_bar', 999 );
function custom_wp_admin_bar( $wp_admin_bar ) {
$wp_admin_bar->remove_node( 'new-content' );
$wp_admin_bar->remove_node( 'comments' );
$wp_admin_bar->remove_node( 'wp-logo' );
$wp_admin_bar->remove_node( 'my-account' );
$wp_admin_bar->remove_node( 'view' );
$wp_admin_bar->remove_node( 'view-site' );
$wp_admin_bar->remove_node( 'view-store' );
$args = array(
	'id' => 'wp-custom-logout',
	'title' => 'Cerrar Sesión',
	'href' => wp_logout_url('/login/'),
	'meta' => array( 'class' => 'custom-logout' )
);
$wp_admin_bar->add_node( $args );

}
/* ------------- Customize Login Logo */
function my_login_logo() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$custom_logo_url = wp_get_attachment_image_src( $custom_logo_id , 'full' );
?>
<style type="text/css">
#login h1 a,
.login h1 a {
		background-image: url(<?php echo $custom_logo_url[0]; ?>);
		height: 84px;
		width: 100%;
		background-size: contain;
		background-repeat: no-repeat;
}
#login #nav a, #login .privacy-policy-page-link, #login .forgetmenot,
#login #backtoblog {
	 display:none;
}
#login .button-primary {
	background:#222;
	border-color:#222;
}
#login .dashicons-visibility::before, #factoria-footer a  {
	color:#222;
}
#login input[type="text"]:focus,
#login input[type="password"]:focus,
#login input[type="checkbox"]:focus {
	border-color:#222;
	border-width:2px;
	box-shadow:0 0 0;
}
</style>
<?php
}
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_footer() {
	echo '<div id="santa-footer" style="width:320px; margin:0 auto">'
	. '<p style="text-align:center; margin-top:20px">'
	. 'Framework basado en Wordpress desarrollado por '
	. '<a href="https://www.santacole.com" target="_blank">'
	. 'Intramundana</a></p>'
	. '</div>';
}
add_action('login_footer','my_login_footer');

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

/* Hide Login */

add_filter( 'logout_url', 'custom_logout_url' );
function custom_logout_url( $default ){
	return str_replace( 'wp-login', 'santa-login', $default );
}
/* add_filter( 'login_url', 'custom_login_url' );
function custom_login_url( $default ){
	return str_replace( 'wp-login', 'santa-login', $default );
} */
