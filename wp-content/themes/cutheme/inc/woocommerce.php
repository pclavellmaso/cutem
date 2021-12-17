<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package santa_cole
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function santa_cole_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 240,
			'single_image_width'    => 500,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'santa_cole_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function santa_cole_woocommerce_scripts() {
	wp_enqueue_style( 'santa-cole-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'santa-cole-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'santa_cole_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function santa_cole_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'santa_cole_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function santa_cole_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'santa_cole_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'santa_cole_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function santa_cole_woocommerce_wrapper_before() {
		?>
<main id="primary" class="site-main">
    <?php
	}
}
add_action( 'woocommerce_before_main_content', 'santa_cole_woocommerce_wrapper_before' );

if ( ! function_exists( 'santa_cole_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function santa_cole_woocommerce_wrapper_after() {
		?>
</main><!-- #main -->
<?php
	}
}
add_action( 'woocommerce_after_main_content', 'santa_cole_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'santa_cole_woocommerce_header_cart' ) ) {
			santa_cole_woocommerce_header_cart();
		}
	?>
*/

if ( ! function_exists( 'santa_cole_woocommerce_cart_link_fragment' ) ) {
/**
* Cart Fragments.
*
* Ensure cart contents update when products are added to the cart via AJAX.
*
* @param array $fragments Fragments to refresh via AJAX.
* @return array Fragments to refresh via AJAX.
*/
function santa_cole_woocommerce_cart_link_fragment( $fragments ) {
ob_start();
santa_cole_woocommerce_cart_link();
$fragments['a.cart-contents'] = ob_get_clean();

return $fragments;
}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'santa_cole_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'santa_cole_woocommerce_cart_link' ) ) {
/**
* Cart Link.
*
* Displayed a link to the cart including the number of items present and the cart total.
*
* @return void
*/
function santa_cole_woocommerce_cart_link() {
?>
<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>"
    title="<?php esc_attr_e( 'View your shopping cart', 'santa-cole' ); ?>">
    <?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'santa-cole' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
    <span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span
        class="count"><?php echo esc_html( $item_count_text ); ?></span>
</a>
<?php
	}
}

if ( ! function_exists( 'santa_cole_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function santa_cole_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
<ul id="site-header-cart" class="site-header-cart">
    <li class="<?php echo esc_attr( $class ); ?>">
        <?php santa_cole_woocommerce_cart_link(); ?>
    </li>
    <li>
        <?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
    </li>
</ul>
<?php
	}
}

/**
 * Checkout
 *
 * Create account checkbox selected by default
 *
 */

add_filter('woocommerce_create_account_default_checked' , function ($checked){
    return true;
});

/**
 * Checkout
 *
 * Rename checkout fields
 *
 */

/* add_filter( 'woocommerce_checkout_fields' , 'rename_account_password' );
function rename_account_password( $fields ) {
		$fields['account']['account_password']['label'] = pll__('Type your password below');
    return $fields;
} */

/**
 * Single Product
 *
 * Remove actions to avoid extra content on product page
 *
 */

/* remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 ); */

/* add_filter('woocommerce_single_product_image_thumbnail_html','wc_remove_link_on_thumbnails' );

function wc_remove_link_on_thumbnails( $html ) {
return strip_tags( $html,'<div>' );
} */

function remove_product_zoom_support() {
    //remove_theme_support( 'wc-product-gallery-zoom' );
	remove_theme_support( 'wc-product-gallery-slider' );
	//remove_theme_support( 'wc-product-gallery-lighbox' );
}
add_action( 'wp', 'remove_product_zoom_support', 100 );



/**
 * overwritten from https://woocommerce.wp-a2z.org/oik_api/wc_get_gallery_image_html/
 */
function my_custom_img_function($attachment_id, $main_image = false){
    $flexslider        = (bool) apply_filters('woocommerce_single_product_flexslider_enabled', get_theme_support('wc-product-gallery-slider'));
    $gallery_thumbnail = wc_get_image_size('gallery_thumbnail');
    $thumbnail_size    = apply_filters('woocommerce_gallery_thumbnail_size', array($gallery_thumbnail['width'], $gallery_thumbnail['height']));
    $image_size        = apply_filters('woocommerce_gallery_image_size', $flexslider || $main_image ? 'woocommerce_single' : $thumbnail_size);
    $full_size         = apply_filters('woocommerce_gallery_full_size', apply_filters('woocommerce_product_thumbnails_large_size', 'full'));
    $thumbnail_src     = wp_get_attachment_image_src($attachment_id, $thumbnail_size);
    $full_src          = wp_get_attachment_image_src($attachment_id, $full_size);
    $alt_text          = trim(wp_strip_all_tags(get_post_meta($attachment_id, '_wp_attachment_image_alt', true)));
    $image             = wp_get_attachment_image(
        $attachment_id,
        $image_size,
        false,
        apply_filters(
            'woocommerce_gallery_image_html_attachment_image_params',
            array(
                'title'                   => _wp_specialchars(get_post_field('post_title', $attachment_id), ENT_QUOTES, 'UTF-8', true),
                'data-caption'            => _wp_specialchars(get_post_field('post_excerpt', $attachment_id), ENT_QUOTES, 'UTF-8', true),
                'data-src'                => esc_url($full_src[0]),
                'data-large_image'        => esc_url($full_src[0]),
                'data-large_image_width'  => esc_attr($full_src[1]),
                'data-large_image_height' => esc_attr($full_src[2]),
                'class'                   => esc_attr($main_image ? 'wp-post-image' : ''),
            ),
            $attachment_id,
            $image_size,
            $main_image
        )
    );
    return '<a class="woocommerce-product-gallery__image" href="' . esc_url($full_src[0]) . '" >
	<img src="' . esc_url($full_src[0]). '" loading="lazy" class="wp-post-image img-fluid aqui" alt="'.$alt_text.'">
	</a>';
    
}


/* function add_link_woocommerce_single_product_image_thumbnail_html( $html, $post_thumbnail_id ) {

    //This will only add the link on a single product page.
    
    if ( is_product() ) :
        global $product;
        $product_id = $product->get_id();
        $product_url = get_permalink( $product_id );
        $main_image = true;
        $flexslider        = (bool) apply_filters( 'woocommerce_single_product_flexslider_enabled', get_theme_support( 'wc-product-gallery-slider' ) );
        $gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
        $thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
        $image_size        = apply_filters( 'woocommerce_gallery_image_size', $flexslider || $main_image ? 'woocommerce_single' : $thumbnail_size );
        $full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
        $thumbnail_src     = wp_get_attachment_image_src( $post_thumbnail_id, $thumbnail_size );
        $full_src          = wp_get_attachment_image_src( $post_thumbnail_id, $full_size );
        $alt_text          = trim( wp_strip_all_tags( get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true ) ) );
        $image             = wp_get_attachment_image(
            $post_thumbnail_id,
            $image_size,
            false,
            apply_filters(
                'woocommerce_gallery_image_html_attachment_image_params',
                array(
                    'title'                   => _wp_specialchars( get_post_field( 'post_title', $post_thumbnail_id ), ENT_QUOTES, 'UTF-8', true ),
                    'data-caption'            => _wp_specialchars( get_post_field( 'post_excerpt', $post_thumbnail_id ), ENT_QUOTES, 'UTF-8', true ),
                    'data-src'                => esc_url( $full_src[0] ),
                    'data-large_image'        => esc_url( $full_src[0] ),
                    'data-large_image_width'  => esc_attr( $full_src[1] ),
                    'data-large_image_height' => esc_attr( $full_src[2] ),
                    'class'                   => esc_attr( $main_image ? 'wp-post-image aaaqui' : '' ),
                ),
                $post_thumbnail_id,
                $image_size,
                $main_image
            )
        );
        $html = '<div data-thumb="' . esc_url( $thumbnail_src[0] ) . '" data-thumb-alt="' . esc_attr( $alt_text ) . '" class="woocommerce-product-gallery__image">
		<a href="' . esc_url( $product_url ) . '/?add-to-cart=' . $product_id .  '">' . $image . '</a>
		</div>';

        return $html;
    endif; 

    return $html;
}
add_filter( 'woocommerce_single_product_image_thumbnail_html', 'add_link_woocommerce_single_product_image_thumbnail_html', 10, 2 );
 */

add_filter( 'woocommerce_product_add_to_cart_text', 'mich_wc_change_add_to_cart_text' );
add_filter( 'woocommerce_product_single_add_to_cart_text', 'mich_wc_change_add_to_cart_text' );

function mich_wc_change_add_to_cart_text() {
  
  return __('Añadir a la cesta', 'woocommerce');
}


add_action( 'woocommerce_before_single_product', 'cspl_change_single_product_layout' );
function cspl_change_single_product_layout() {
    // Disable the hooks so that their order can be changed.
    //remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

    
    // Include the category/tags info.
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 10 );
    // Then the product short description.
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 30 );
    // Put the price first.
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 40 );
    // And finally include the 'Add to cart' section.
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 50 );
}

remove_action( 'woocommerce_after_single_product_summary','woocommerce_output_product_data_tabs', 10 );
// AÑADIR AL PRINCIPIO INFO DENTRO DE META.PHP OPCIÓN 2

/* add_action('woocommerce_product_meta_start','add_pet_info' );
function add_pet_info() {
    _e( "Test Text", "santa-cole" );
} */


/* SELECTOR DE CANTIDAD DEL PRODUCTO

add_filter( 'woocommerce_widget_cart_item_quantity', 'add_minicart_quantity_fields', 10, 3 );
function add_minicart_quantity_fields( $html, $cart_item, $cart_item_key ) {
    $product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $cart_item['data'] ), $cart_item, $cart_item_key );

    return woocommerce_quantity_input( array('input_value' => $cart_item['quantity']), $cart_item['data'], false ) . $product_price;
} */


/* SOLO MOSTRAR PRECIOS */
/* 
function add_price_widget(){
    $product = wc_get_product(get_the_ID());
    $thePrice = $product->get_price(); //will give raw price
    echo $thePrice;
	//echo wc_price( wc_get_price_including_tax( $product ) );
} */




/*
* Añadir casilla NIF en el checkout
*/

function woo_custom_field_checkout($checkout) {

    woocommerce_form_field( 'nif', array( // Identificador del campo 
        'type'          => 'text',
        'class'         => array('form-row-wide '),
        'required'      => true,            // Aquí muestra que no es obligatorio, si queres que sea obligatorio pon 'True' en vez de 'False'
        //   'label'       => __('NIF / CIF'),   // Nombre del campo 
        'placeholder'   => __('NIF / CIF'), // Texto guía que se muestra dentro de la celda.
        ), $checkout->get_value( 'nif' ));    // Identificador del campo 
  

  }
  add_action( 'woocommerce_after_checkout_billing_form', 'woo_custom_field_checkout' );


function woo_custom_field_checkout_custom($checkout) {


    //CAMPOS PARA LA GALERIA EMPRESAS 
	woocommerce_form_field( 'factory', array( // Identificador del campo 
        'type'          => 'text',
        'class'         => array('form-row-wide factory'),
        'required'      => false,            // Aquí muestra que no es obligatorio, si queres que sea obligatorio pon 'True' en vez de 'False'¡
        'placeholder'   => __('Razón social'), // Texto guía que se muestra dentro de la celda.
    ), $checkout->get_value( 'factory-razon-social' ));    // Identificador del campo
    woocommerce_form_field( 'factoryemail', array( // Identificador del campo 
        'type'          => 'email',
        'class'         => array('form-row-wide factoryemail'),
        'required'      => false,            // Aquí muestra que no es obligatorio, si queres que sea obligatorio pon 'True' en vez de 'False'¡
        'placeholder'   => __('Email'), // Texto guía que se muestra dentro de la celda.
    ), $checkout->get_value( 'factory-email' ));    // Identificador del campo 
    woocommerce_form_field( 'factoryphone', array( // Identificador del campo 
        'type'          => 'tel',
        'class'         => array('form-row-wide factoryphone'),
        'required'      => false,            // Aquí muestra que no es obligatorio, si queres que sea obligatorio pon 'True' en vez de 'False'¡
        'placeholder'   => __('Teléfono'), // Texto guía que se muestra dentro de la celda.
    ), $checkout->get_value( 'factory-phone' ));    // Identificador del campo
    woocommerce_form_field( 'factorydireccion', array( // Identificador del campo 
        'type'          => 'text',
        'class'         => array('form-row-wide factorydireccion'),
        'required'      => false,            // Aquí muestra que no es obligatorio, si queres que sea obligatorio pon 'True' en vez de 'False'¡
        'placeholder'   => __('Dirección'), // Texto guía que se muestra dentro de la celda.
    ), $checkout->get_value( 'factory-address' ));    // Identificador del campo    
    woocommerce_form_field( 'factorynif', array( // Identificador del campo 
        'type'          => 'text',
        'class'         => array('form-row-wide factorynif'),
        'required'      => false,            // Aquí muestra que no es obligatorio, si queres que sea obligatorio pon 'True' en vez de 'False'
        //   'label'       => __('NIF / CIF'),   // Nombre del campo 
        'placeholder'   => __('NIF / CIF de empresa'), // Texto guía que se muestra dentro de la celda.
        ), $checkout->get_value( 'factory-nif' ));    // Identificador del campo 
    woocommerce_form_field( 'factorycp', array( // Identificador del campo 
        'type'          => 'text',
        'class'         => array('form-row-wide factorycp'),
        'required'      => false,            // Aquí muestra que no es obligatorio, si queres que sea obligatorio pon 'True' en vez de 'False'¡
        'placeholder'   => __('C.P'), // Texto guía que se muestra dentro de la celda.
    ), $checkout->get_value( 'factory-cp' ));    // Identificador del campo 
    woocommerce_form_field( 'factoryciudad', array( // Identificador del campo 
        'type'          => 'text',
        'class'         => array('form-row-wide factoryciudad'),
        'required'      => false,            // Aquí muestra que no es obligatorio, si queres que sea obligatorio pon 'True' en vez de 'False'¡
        'placeholder'   => __('Ciudad'), // Texto guía que se muestra dentro de la celda.
    ), $checkout->get_value( 'factory-ciudad' ));    // Identificador del campo
    woocommerce_form_field( 'factorypais', array( // Identificador del campo 
        'type'          => 'text',
        'class'         => array('form-row-wide factorypais'),
        'required'      => false,            // Aquí muestra que no es obligatorio, si queres que sea obligatorio pon 'True' en vez de 'False'¡
        'placeholder'   => __('País'), // Texto guía que se muestra dentro de la celda.
    ), $checkout->get_value( 'factory-pais' ));    // Identificador del campo

    woocommerce_form_field( 'factoryactivempresa', array( // Identificador del campo 
        'type'          => 'text',
        'class'         => array('form-row-wide factoryactivempresa'),
        'required'      => false,            // Aquí muestra que no es obligatorio, si queres que sea obligatorio pon 'True' en vez de 'False'¡
        'placeholder'   => __('activempresa'), // Texto guía que se muestra dentro de la celda.
    ), $checkout->get_value( 'factory-activempresa' ));    // Identificador del campo
    
    

  }
  add_action( 'woocommerce_before_checkout_billing_form', 'woo_custom_field_checkout_custom' );

  


//Validacion campos active tap de empresas
add_action( 'woocommerce_after_checkout_validation', 'shipping_time_optionss', 9999, 2);
function shipping_time_optionss( $fields, $errors ){
	// if any validation errors
    if( $_POST['factoryactivempresa'] == '1' ){

        if ( 
            empty( $_POST['factory'] ) || empty( $_POST['factoryemail'] ) || empty( $_POST['factoryphone'] ) || empty( $_POST['factorydireccion'] ) || empty( $_POST['factorynif'] )      
            || empty( $_POST['factorycp'] ) || empty( $_POST['factoryciudad'] )  || empty( $_POST['factorypais'] )
        ) {
            $errors->add( 'woocommerce_password_error', __( 'Todos los campos de empresa son requeridos.' ) );
        }
        

    }
} 

// Update the order meta with field value
add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta', 10, 1 );
function my_custom_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['nif'] ) ) {
        update_post_meta( $order_id, 'NIF', sanitize_text_field( $_POST['nif'] ) );
    }
    if ( ! empty( $_POST['factory'] ) ) {
        update_post_meta( $order_id, 'factory-razon-social', sanitize_text_field( $_POST['factory'] ) );
    }
    if ( ! empty( $_POST['factoryemail'] ) ) {
        update_post_meta( $order_id, 'factory-email', sanitize_text_field( $_POST['factoryemail'] ) );
    }
    if ( ! empty( $_POST['factorydireccion'] ) ) {
        update_post_meta( $order_id, 'factory-address', sanitize_text_field( $_POST['factorydireccion'] ) );
    }
    if ( ! empty( $_POST['factorynif'] ) ) {
        update_post_meta( $order_id, 'factory-nif', sanitize_text_field( $_POST['factorynif'] ) );
    }
    if ( ! empty( $_POST['factorycp'] ) ) {
        update_post_meta( $order_id, 'factory-cp', sanitize_text_field( $_POST['factorycp'] ) );
    }
    if ( ! empty( $_POST['factoryciudad'] ) ) {
        update_post_meta( $order_id, 'factory-ciudad', sanitize_text_field( $_POST['factoryciudad'] ) );
    }
    if ( ! empty( $_POST['factorypais'] ) ) {
        update_post_meta( $order_id, 'factory-pais', sanitize_text_field( $_POST['factorypais'] ) );
    }
    if ( ! empty( $_POST['factoryphone'] ) ) {
        update_post_meta( $order_id, 'factory-phone', sanitize_text_field( $_POST['factoryphone'] ) );
    }
}


// Display the custom-field in orders view


  /*
  * MUESTRA EL VALOR DEL CAMPO NIF/CIF LA PÁGINA DE MODIFICACIÓN DEL PEDIDO
  */
  function woo_custom_field_checkout_edit_order($order){
	// echo '<p><strong>'.__('NIF').':</strong> <br>' . get_post_meta( $order->id, 'NIF', true ) . '</p>';
	echo '<p><strong>'.__('NIF').':</strong> <br>' . get_post_meta( $order->get_id(), 'NIF', true ) . '</p>';
  }
  add_action( 'woocommerce_admin_order_data_after_billing_address', 'woo_custom_field_checkout_edit_order', 10, 1 );

  function woo_custom_field_checkout_factory_order($order){
	echo '<div style="clear: both;"></div><hr><h4>Datos de empresa</h4><p><strong>'.__('Razón social').':</strong> ' . get_post_meta( $order->get_id(), 'factory-razon-social', true ) . '</p>';
	echo '<p><strong>'.__('Email').':</strong> ' . get_post_meta( $order->get_id(), 'factory-email', true ) . '</p>';
	echo '<p><strong>'.__('Teléfono').':</strong> ' . get_post_meta( $order->get_id(), 'factory-phone', true ) . '</p>';
	echo '<p><strong>'.__('Dirección').':</strong> ' . get_post_meta( $order->get_id(), 'factory-address', true ) . '</p>';
	echo '<p><strong>'.__('CIF/NIF de empresa').':</strong> ' . get_post_meta( $order->get_id(), 'factory-nif', true ) . '</p>';
	echo '<p><strong>'.__('C.P').':</strong> ' . get_post_meta( $order->get_id(), 'factory-cp', true ) . '</p>';
	echo '<p><strong>'.__('Ciudad').':</strong> ' . get_post_meta( $order->get_id(), 'factory-ciudad', true ) . '</p>';
	echo '<p><strong>'.__('País').':</strong> ' . get_post_meta( $order->get_id(), 'factory-pais', true ) . '</p>';
	
  }
  add_action( 'woocommerce_admin_order_data_after_shipping_address', 'woo_custom_field_checkout_factory_order', 10, 1 );
  /*
  * INCLUYE EL CAMPO NIF/CIF EN EL CORREO ELECTRÓNICO DE AVISO A TU CLIENTE
  */
function woo_custom_field_checkout_email($keys) {
	$keys[] = 'NIF';
	return $keys;
  }
  add_filter('woocommerce_email_order_meta_keys', 'woo_custom_field_checkout_email');




  /**
*Añadir el CIF automáticamente en el plugin de facturas 'WooCommerce PDF Invoices & Packing Slips'
*/

/* add_filter( 'wpo_wcpdf_billing_address', 'anadir_cif_factura' );
 
function anadir_cif_factura( $address ){
  global $wpo_wcpdf;
 
  echo $address . '<p>';
  $wpo_wcpdf->custom_field( 'NIF', 'NIF: ' );
  echo '</p>';
} */


/* PESTAÑA DE FAVORITOS */
/* añadir una pestaña a la pagina de mi cuenta en woocommerce */
/*
* Step 1. Add Link (Tab) to My Account menu
*/
add_filter ( 'woocommerce_account_menu_items', 'misha_favoritos_link', 40 );
function misha_favoritos_link( $menu_links ){
	
	$menu_links = array_slice( $menu_links, 0, 2, true ) 
	+ array( 'favoritos' => __('Favoritos', 'woocommerce') )
	+ array_slice( $menu_links, 2, NULL, true );
	
	return $menu_links;

}

add_filter ( 'woocommerce_account_menu_items', 'misha_bandeja_link', 40 );
function misha_bandeja_link( $menu_links ){
	
	$menu_links = array_slice( $menu_links, 0, 3, true ) 
	+ array( 'bandeja' => __('Bandeja de entrada', 'woocommerce') )
	+ array_slice( $menu_links, 3, NULL, true );
	
	return $menu_links;

}
/*
 * Step 2. Register Permalink Endpoint
 */
add_action( 'init', 'misha_add_endpoint' );
function misha_add_endpoint() {
	// WP_Rewrite is my Achilles' heel, so please do not ask me for detailed explanation
	add_rewrite_endpoint( 'favoritos', EP_PAGES );
}

add_action( 'init', 'mich_bandeja_add_endpoint' );
function mich_bandeja_add_endpoint() {
	// WP_Rewrite is my Achilles' heel, so please do not ask me for detailed explanation
	add_rewrite_endpoint( 'bandeja', EP_PAGES );
}

/*
 * Step 3. Content for the new page in My Account, woocommerce_account_{ENDPOINT NAME}_endpoint
 */
add_action( 'woocommerce_account_favoritos_endpoint', 'misha_my_account_endpoint_content' );
function misha_my_account_endpoint_content() {
	// of course you can print dynamic content here, one of the most useful functions here is get_current_user_id()
	echo do_shortcode('[yith_wcwl_wishlist]');
}

add_action( 'woocommerce_account_bandeja_endpoint', 'mich_bandeja_my_account_endpoint_content' );
function mich_bandeja_my_account_endpoint_content() {
	// of course you can print dynamic content here, one of the most useful functions here is get_current_user_id()
	echo do_shortcode('[comunicaciones]');
   
					    
}

/*
 * Step 4
 */
// Go to Settings > Permalinks and just push "Save Changes" button.





add_filter('woocommerce_checkout_fields', 'checkout_placeholder');
function checkout_placeholder($fields){

		$fields['billing']['billing_company']['placeholder'] = __('Nombre de la empresa');
		$fields['billing']['billing_company']['label'] = '';
		$fields['billing']['billing_first_name']['placeholder'] = __('Nombre');
		$fields['billing']['billing_first_name']['label'] = '';
		$fields['shipping']['shipping_first_name']['placeholder'] = __('Nombre');
		$fields['shipping']['shipping_first_name']['label'] = '';
		$fields['shipping']['shipping_last_name']['placeholder'] = __('Apellidos');
		$fields['shipping']['shipping_last_name']['label'] = '';
		$fields['shipping']['shipping_company']['placeholder'] =  __('Nombre de la empresa');
		$fields['shipping']['shipping_company']['label'] = '';
		$fields['billing']['billing_last_name']['placeholder'] = __('Apellidos');
		$fields['billing']['billing_last_name']['label'] = '';
		$fields['billing']['billing_email']['placeholder'] = __('Email');
		$fields['billing']['billing_email']['label'] = '';
		$fields['billing']['billing_phone']['placeholder'] = __('Teléfono');
		$fields['billing']['billing_phone']['label'] = '';
		$fields['billing']['billing_address_1']['placeholder'] = __('Dirección');
		$fields['billing']['billing_address_1']['label'] = '';
		$fields['billing']['billing_address_2']['placeholder'] = __('Piso / Escalera / Puerta');
		$fields['billing']['billing_address_2']['label'] = '';
		$fields['billing']['billing_postcode']['placeholder'] = __('Código postal');
		$fields['billing']['billing_postcode']['label'] = '';
		$fields['billing']['billing_city']['placeholder'] = __('Localidad / Ciudad');
		$fields['billing']['billing_city']['label'] = '';
		$fields['billing']['billing_country']['placeholder'] = __('País');
		$fields['billing']['billing_country']['label'] = '';
		$fields['billing']['billing_state']['placeholder'] = __('Provincia');
		$fields['billing']['billing_state']['label'] = '';		
 	return $fields;

 }




/* ELIMINAR PRODUCTOS RELACIONADOS */
remove_action ('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

/* COMPATIBILIDAD DEL TEMA CON WOOC */
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
add_theme_support( 'woocommerce' );
}

/* ESTO ES PARA CAMBIAR EL TAMAÑO DEL LAS IMAGENES DEL LOOP DE PRODUCTOS */
/* add_action('init', function(){
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
    add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
});

if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
    function woocommerce_template_loop_product_thumbnail() {
        echo woocommerce_get_product_thumbnail();
    } 
}

if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {   
    function woocommerce_get_product_thumbnail( $size = 'woocommerce_single' ) {
        global $post, $woocommerce;
        $output = '<figure>';

        if ( has_post_thumbnail() ) {               
            $output .= get_the_post_thumbnail( $post->ID, $size );
        } else {
             $output .= wc_placeholder_img( $size );
            // Or alternatively setting yours width and height shop_catalog dimensions.
            //$output .= '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="400px" height="auto" />';
        }                       
        $output .= '</figure>';
        return $output;
    }
} */


/* ESTO ES PARA CREAR SHORTCODE PARA MOSTRAR LA INFORMACIÓN ADICIONAL COMO PESO Y DIMENSIONES */

if ( ! function_exists( 'display_product_additional_information' ) ) {

    function display_product_additional_information($atts) {

        // Shortcode attribute (or argument)
        $atts = shortcode_atts( array(
            'id'    => ''
        ), $atts, 'product_additional_information' );

        // If the "id" argument is not defined, we try to get the post Id
        if ( ! ( ! empty($atts['id']) && $atts['id'] > 0 ) ) {
           $atts['id'] = get_the_id();
        }

        // We check that the "id" argument is a product id
        if ( get_post_type($atts['id']) === 'product' ) {
            $product = wc_get_product($atts['id']);
        }
        // If not we exit
        else {
            return;
        }

        ob_start(); // Start buffering

        do_action( 'woocommerce_product_additional_information', $product );

        return ob_get_clean(); // Return the buffered outpout
    }

    add_shortcode('product_additional_information', 'display_product_additional_information');

}


/* PARA OPTENER EL ID DE LA CATEGORIA PADRE DEL PRODUCTO Y A SU VES MOSTRAR SOLO SUBCATEGORIAS DE PRODUCTO*/

function Michwoo_get_product_parent_cats( $product_id ) {
    $cats = array();
    $terms = get_the_terms( $product_id, 'product_cat' );
    foreach ($terms as $term) {
        if (empty($term->parent)) {
            $cats[] = $term->term_id;
        } 
    }

	$parentid = $cats;

	$args = array(
		'parent' => $parentid
	);
	
	$terms_sub = get_terms( 'product_cat', $args );
	
	if ( $terms_sub ) {
			
		foreach ( $terms_sub as $term ) {
							
			//woocommerce_subcategory_thumbnail( $term );
			
			echo '<span class="posted_in category-product-ficha">';
				echo '<a href="' .  esc_url( get_term_link( $term ) ) . '" class="' . $term->slug . '">';
					echo $term->name;
				echo '</a>';
			echo '</span>';
																		
		}
	
	}
    //return implode(', ', $cats);
}

function Polwoo_get_product_child_cat( $product_id ) {
 
    // Recibimos post object o post id

    if ($product_id) {

        $product = wc_get_product($product_id);

        // Si tiene padre (variación de producto)
        if ($product->get_parent_id()) {
                
            $product_id = $product->get_parent_id();
        }

        $terms = get_the_terms( $product_id, 'product_cat' );
        
        if ($terms) {
            $padre = false;
            foreach ($terms as $term) {
                // Si la categoria tiene una categoria padre (más prioridad, ya que buscamos la hija)
                if ($term->parent != 0) {
    
                    // Aunque ya haya una categoria sin padre asignada (menos prioridad) la sobreescribimos
                    $term_final = $term;
                    $padre = true;
                // Si no tiene padre (menos prioridad)
                } else {
                    // Si NO hay una categoria asignada con más prioridad (con padre) asignamos esta (sin padre)
                    if (!$padre) {
                        $term_final = $term;
                    }
                }
            }
                    
            echo '<span class="posted_in category-product-ficha">';
                echo '<a href="' .  esc_url( get_term_link( $term_final ) ) . '" class="' . $term_final->slug . '">';
                    echo $term_final->name;
                echo '</a>';
            echo '</span>';
        } else {
            // nothing
        }
        
    } else {
        echo '';
    }
    
}

function Polwoo_get_product_child_cat_a( $product_id ) {

    $terms = get_the_terms( $product_id, 'product_cat' );

    $padre = false;
    foreach ($terms as $term) {
        // Si tiene padre (más prioridad)
        if ($term->parent != 0) {

            // Aunque ya haya una categoria sin padre asignada (menos prioridad) la sobreescribimos
            $term_final = $term;
            $padre = true;
        // Si no tiene padre (menos prioridad)
        } else {
            // Si NO hay una categoria asignada con más prioridad (con padre) asignamos esta (sin padre)
            if (!$padre) {
                $term_final = $term;
            }
        }
    }

    $html = '<a href="' .  esc_url( get_term_link( $term_final ) ) . '" class="' . $term_final->slug . '">' . $term_final->name . '</a>';
    return $html;
}


function yov_get_product_child_cat( $product_id ) {

    $terms = get_the_terms( $product_id, 'product_cat' );

    $padre = false;
    foreach ($terms as $term) {
        // Si tiene padre (más prioridad)
        if ($term->parent != 0) {

            // Aunque ya haya una categoria sin padre asignada (menos prioridad) la sobreescribimos
            $term_final = $term;
            $padre = true;
        // Si no tiene padre (menos prioridad)
        } else {
            // Si NO hay una categoria asignada con más prioridad (con padre) asignamos esta (sin padre)
            if (!$padre) {
                $term_final = $term;
            }
        }
    }

    $html = esc_url( get_term_link( $term_final ) );
    return $html;
}



function Polwoo_get_product_child_cat_id( $product_id ) {

    $terms = get_the_terms( $product_id, 'product_cat' );

    $padre = false;
    foreach ($terms as $term) {
        // Si tiene padre (más prioridad)
        if ($term->parent != 0) {

            // Aunque ya haya una categoria sin padre asignada (menos prioridad) la sobreescribimos
            $term_final = $term;
            $padre = true;
        // Si no tiene padre (menos prioridad)
        } else {
            // Si NO hay una categoria asignada con más prioridad (con padre) asignamos esta (sin padre)
            if (!$padre) {
                $term_final = $term;
            }
        }
    }
    return $term_final->term_id;
}


function custom_wc_ajax_variation_threshold( $qty, $product ) {
    return 1000;
}

add_filter( 'woocommerce_ajax_variation_threshold', 'custom_wc_ajax_variation_threshold', 10, 2 );
/* add_filter('woocommerce_reset_variations_link', '__return_empty_string'); */

/* ******************************************
*********************************************
** OBTENER EL ID DEL PRODUCTO APARTIR DEL SKU
*********************************************
*********************************************
function IDProduct_By_Sku_Mich($Skus){
    global $wpdb;
    $QuerySku = "SELECT post_id FROM sc_wp_postmeta WHERE meta_key = '_sku' AND meta_value = '$Skus'";
    $Post_id = $wpdb->consultar($QuerySku);
    return $Post_id;
}
********************************************/


function IDProduct_By_Sku_Mich($Skus,$idioma){
    require get_template_directory() . '/config.php';
    //$QuerySku = "SELECT post_id FROM sc_wp_postmeta WHERE meta_key = '_sku' AND meta_value = '$Skus'";
    $QuerySku = "SELECT `post_id` FROM `sc_wp_postmeta` WHERE meta_key = '_sku' AND `meta_value` = '$Skus' AND post_id IN (SELECT element_id FROM `sc_wp_icl_translations` WHERE language_code LIKE '$idioma')";
    $Post_id = $bd_wp->consultar($QuerySku);
    if ($Post_id != null) {
        $Post_id = $Post_id[0]['post_id'];
    }else {
        $Post_id = 000;
    }
    
    return $Post_id;
}



/**
 * Hide not-visible variations
 */
add_filter( 'woocommerce_hide_invisible_variations', '__return_true' );



/**
 * AJUSTES PARA MOSTRAR EL PRECIO DIFERENTE DEPENDIENDO DEL IDIOMA
 */


add_filter( 'pre_option_woocommerce_currency_pos', 'change_currency_position' );
function change_currency_position(){
    $language_actual = apply_filters( 'wpml_current_language', NULL );
    if($language_actual == 'en' ){
        return 'left';
    }else {
		return 'right';
	}
}

//add the action 
add_filter('wc_get_price_thousand_separator', 'custom_wc_get_price_thousand_separator', 10, 1);

function custom_wc_get_price_thousand_separator( $get_option ){ 
    $language_actual = apply_filters( 'wpml_current_language', NULL );
   //custom code here
   if($language_actual == 'es' ){
    return  '.';
   }else {
	   return  ',';
   }  
}


add_filter('wc_get_price_decimal_separator', 'custom_wc_get_price_decimal_separator', 10, 1);

function custom_wc_get_price_decimal_separator( $get_option ){ 
    $language_actual = apply_filters( 'wpml_current_language', NULL );
   //custom code here
   if($language_actual == 'es' ){
    return  ',';
   }else {
	   return  '.';
   }  
}

/*
    ELIMINO DEL - EN ADALENTE PARA LOS PRODUCTO VARIABLES
*/
function before ($thisde, $inthat){
    $pos = strpos( $inthat, '-');
    if ( $pos === false ) {
        return $inthat;
    }else{
        return substr($inthat, 0, strpos($inthat, $thisde));
    }
}

function custom_format_price($price) {
    // Función que formatea el precio, cambia el separador decimal por una ',' y lo wrapea con html
    //$price = wc_price ($price);
    // Le sacamos el html para dejar el precio numerico a secas
    //$price = explode('<bdi>', $price)[1];
    //$price = explode('<span', $price)[0];
    return $price;
}

//PARA PONER EL NOMBRE Y APELLIDO EN EL REGISTRO DE WOOCOMMERCE
add_action( 'woocommerce_register_form_start', 'add_name_to_register_woocommerce' );
function add_name_to_register_woocommerce() {
    ?>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" placeholder="<?php _e( 'First name', 'woocommerce' ); ?> " />
        </p>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide"> 
            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" placeholder="<?php _e( 'Last name', 'woocommerce' ); ?> " />
        </p>
 
    <?php
}
//PARA AÑADIR EL CHECKBOX DE PRIVACIDAD EN REGISTRO WOOCOMMERCE
add_action( 'woocommerce_register_form', 'add_privacy_checkbox', 9 );
function add_privacy_checkbox() {
    woocommerce_form_field( 'privacy_policy', array(
        'type' => 'checkbox',
        'class' => array('form-row privacy'),
        'label_class' => array('woocommerce-form__label woocommerce-form__label-for-checkbox checkbox'),
        'input_class' => array('woocommerce-form__input woocommerce-form__input-checkbox input-checkbox'),
        'required' => true,
        'label' => '<span>'.__('He leído y acepto los términos y condiciones, así como la').' <a href="https://www.santacole.com/en/about-us/privacy-policy/">'.__('Política de Datos y Privacidad').'</a></span>',
        ));
    woocommerce_form_field( 'news_suscription', array(
        'type' => 'checkbox',
        'class' => array('form-row news-suscription'),
        'label_class' => array('woocommerce-form__label woocommerce-form__label-for-checkbox checkbox'),
        'input_class' => array('woocommerce-form__input woocommerce-form__input-checkbox input-checkbox'),
        'required' => false,
        'label' => '<span>'.__('Suscríbete para ser el primero en recibir información sobre nuestros productos, lanzamientos y eventos especiales').'.</span>',
    ));
    }
    add_action( 'woocommerce_register_post', 'privacy_checkbox_error_message', 10, 3 );
    function privacy_checkbox_error_message() {
        if ( ! (int) isset( $_POST['privacy_policy'] ) ) {
        wc_add_notice( __( 'Debes aceptar la política de privacidad' ), 'error' );
    }
}
//PARA AÑADIR CHECK EN EL PROCESO DE PAGO
add_action( 'woocommerce_review_order_before_submit', 'add_privacy_checkbox_payprosses', 9 );
function add_privacy_checkbox_payprosses() {
    woocommerce_form_field( 'privacy_policy', array(
        'type' => 'checkbox',
        'class' => array('form-row privacy'),
        'label_class' => array('woocommerce-form__label woocommerce-form__label-for-checkbox checkbox'),
        'input_class' => array('woocommerce-form__input woocommerce-form__input-checkbox input-checkbox'),
        'required' => true,
        'label' => '<span>'.__('He leído y acepto los términos y condiciones, así como la').' <a href="https://www.santacole.com/en/about-us/privacy-policy/">'.__('Política de Datos y Privacidad').'</a></span>',
    ));
    woocommerce_form_field( 'news_suscription', array(
        'type' => 'checkbox',
        'class' => array('form-row news-suscription'),
        'label_class' => array('woocommerce-form__label woocommerce-form__label-for-checkbox checkbox'),
        'input_class' => array('woocommerce-form__input woocommerce-form__input-checkbox input-checkbox'),
        'required' => false,
        'label' => '<span>'.__('Suscríbete para ser el primero en recibir información sobre nuestros productos, lanzamientos y eventos especiales').'.</span>',
    ));
    }
    add_action( 'woocommerce_checkout_process', 'privacy_checkbox_error_message_payprosses' );
    function privacy_checkbox_error_message_payprosses() {
        if ( ! (int) isset( $_POST['privacy_policy'] ) ) {
        wc_add_notice( __( '<strong>Política de privacidad</strong> es un campo requerido.' ), 'error' );
    }
}




add_filter ( 'woocommerce_account_menu_items', 'dl_eliminar_pestañas_mi_cuenta' );
function dl_eliminar_pestañas_mi_cuenta( $menu_links ){
 
	unset( $menu_links['dashboard'] ); // Aquí ponemos el que eliminamos(escritorio)
    unset( $menu_links['downloads'] ); // Aquí ponemos el que eliminamos(descargas)
	return $menu_links;
 
}



/*Validar campo NIF de checkout*/
function validDniCifNie($dni){
    $cif = strtoupper($dni);
    for ($i = 0; $i < 9; $i ++){
      $num[$i] = substr($cif, $i, 1);
    }
    // Si no tiene un formato valido devuelve error
    if (!preg_match('/((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)/', $cif)){
      return false;
    }
    // Comprobacion de NIFs estandar
    if (preg_match('/(^[0-9]{8}[A-Z]{1}$)/', $cif)){
      if ($num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($cif, 0, 8) % 23, 1)){
        return true;
      }else{
        return false;
      }
    }
    // Algoritmo para comprobacion de codigos tipo CIF
    $suma = $num[2] + $num[4] + $num[6];
    for ($i = 1; $i < 8; $i += 2){
      $suma += (int)substr((2 * $num[$i]),0,1) + (int)substr((2 * $num[$i]), 1, 1);
    }
    $n = 10 - substr($suma, strlen($suma) - 1, 1);
    // Comprobacion de NIFs especiales (se calculan como CIFs o como NIFs)
    if (preg_match('/^[KLM]{1}/', $cif)){
      if ($num[8] == chr(64 + $n) || $num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($cif, 1, 8) % 23, 1)){
        return true;
      }else{
        return false;
      }
    }
    // Comprobacion de CIFs
    if (preg_match('/^[ABCDEFGHJNPQRSUVW]{1}/', $cif)){
      if ($num[8] == chr(64 + $n) || $num[8] == substr($n, strlen($n) - 1, 1)){
        return true;
      }else{
        return false;
      }
    }
    // Comprobacion de NIEs
    // T
    if (preg_match('/^[T]{1}/', $cif)){
      if ($num[8] == preg_match('/^[T]{1}[A-Z0-9]{8}$/', $cif)){
        return true;
      }else{
        return false;
      }
    }
    // XYZ
    if (preg_match('/^[XYZ]{1}/', $cif)){
      if ($num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr(str_replace(array('X','Y','Z'), array('0','1','2'), $cif), 0, 8) % 23, 1)){
        return true;
      }else{
        return false;
      }
    }
    // Si todavía no se ha verificado devuelve error
    return false;
  }
  
  add_action('woocommerce_checkout_process', 'validateNif');
  function validateNif() {

    if(  !empty( $_POST['nif'])  ){
        $nif =  $_POST['nif'];
    }else{
        $nif =  $_POST['factorynif'];
    }

    $idioma_url = apply_filters( 'wpml_current_language', NULL );
    $toralammount = WC()->cart->total;
    if( $idioma_url == 'es' ){
        $mensaje 	= 'El campo NIF es incorrecto, verifique sus datos';
        $mensajedos = 'El campo NIF es obligatorio cuando la compra es superior a 3000€';
    }else if( $idioma_url == 'en' ){
        $mensaje 	= 'The NIF field is incorrect, check your data';
        $mensajedos = 'The NIF field is mandatory when the purchase is greater than 3000€';
    }
  
    //VERIFICAR CAMPO
    /* if( !empty( $nif ) ){
        if( !validDniCifNie($nif) ){ 
            wc_add_notice(__( $mensaje ), 'error');
        }
    } */
    if ( empty( $nif ) ){
        if($toralammount >= '3000' ){
            wc_add_notice(__( $mensajedos ), 'error');
        }
    }
}
  

/* ---------------------------------------------------------------------------
 * Set hreflang="x-default" with WPML
 * --------------------------------------------------------------------------- */
add_action('wp_head','hook_javascript');
function hook_javascript() {
    $url = get_the_permalink();
    $wpml_permalink_es = apply_filters( 'wpml_permalink', $url , 'es' );
    $wpml_permalink_en = apply_filters( 'wpml_permalink', $url , 'en' );
    $output ='
        <link rel="alternate" hreflang="es" href="'. $wpml_permalink_es .'"  />
        <link rel="alternate" hreflang="en" href="'. $wpml_permalink_en .'"  />
        <link rel="alternate" hreflang="x-default" href="'. $wpml_permalink_en .'"  />
    ';
    echo $output;
}


//Para mostrar la información de empresa en el detalle del pedido
function misha_view_order_page_date( $order ){  
    $curr = wp_get_current_user();
    $loguser =  $curr->user_login;
    if ( $loguser == 'galeriabarcelona' || $loguser == 'galeriabarcelonados'){
            echo '<hr><div class="col-12 col-md-12"><h2>Datos de empresa</h2><p><strong>'.__('Razón social').':</strong> ' . get_post_meta( $order, 'factory-razon-social', true ) . '</br>';
            echo '<strong>'.__('Email').':</strong> ' . get_post_meta( $order, 'factory-email', true ) . '</br>';
            echo '<strong>'.__('Teléfono').':</strong> ' . get_post_meta( $order, 'factory-phone', true ) . '</br>';
            echo '<strong>'.__('Dirección').':</strong> ' . get_post_meta( $order, 'factory-address', true ) . '</br>';
            echo '<strong>'.__('CIF/NIF de empresa').':</strong> ' . get_post_meta( $order, 'factory-nif', true ) . '</br>';
            echo '<strong>'.__('C.P').':</strong> ' . get_post_meta( $order, 'factory-cp', true ) . '</br>';
            echo '<strong>'.__('Ciudad').':</strong> ' . get_post_meta( $order, 'factory-ciudad', true ) . '</br>';
            echo '<strong>'.__('País').':</strong> ' . get_post_meta( $order, 'factory-pais', true ) . '</p>
            </div>
        ';
    }
 } 
 add_action( 'woocommerce_view_order', 'misha_view_order_page_date', 10 );

