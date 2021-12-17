<?php
/**
 * Add last nav item para menu movil
 *
 * @package santa_cole
 */

/* ------------- Get last nav item */

function add_last_nav_item($items,$args) {
	$selector = selector_idiomas_personalizado();
	$language_a = apply_filters( 'wpml_current_language', NULL );
	if ($args->theme_location == 'mobile' && $language_a == 'es') {
		return $items .= (
			
		'<li class="menu-item-custom-mobile d-lg-none">
			<ul id="menu-children-mobile" class="row list-unstyled">
				<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-mobile-19" class="col-12">
					<a title="Mi cuenta" href="https://www.santacole.com/es/mi-cuenta/" class="nav-link text-center d-block border-0">Mi cuenta</a>
				</li>
				<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-mobile-20" class="modal-contact col-6 pr-0">
					<a title="Contacto" href="#" class="nav-link text-center d-block border-0">Contacto</a>
				</li>
				
				<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-mobile-18" class="col-6 pl-0 d-flex justify-content-center align-items-center">
					'. $selector .'
				</li>
			</ul>
		
		</li>');
	} elseif ($args->theme_location == 'mobile' && $language_a == 'en') {
		return $items .= (
			
		'<li class="menu-item-custom-mobile d-lg-none">
			<ul id="menu-children-mobile" class="row list-unstyled">
				<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-mobile-19" class="col-12">
					<a title="Mi cuenta" href="https://www.santacole.com/en/mi-cuenta/" class="nav-link text-center d-block border-0">My account</a>
				</li>
				<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-mobile-20" class="modal-contact col-6 pr-0">
					<a title="Contacto" href="#" class="nav-link text-center d-block border-0">Contact</a>
				</li>
				
				<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-mobile-18" class="col-6 pl-0 d-flex justify-content-center align-items-center">
					'. $selector .'
				</li>
			</ul>
		
		</li>');
	}else {
			return $items;
	}
}
add_filter('wp_nav_menu_items','add_last_nav_item', 10, 2);
