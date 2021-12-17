<?php
/**
 * Custom Users
 *
 * @package santa-cole
 */

/*********************************************************
 * *******************************************************
 * ROLES DE USUARIOS PERSONALIZADOS
 * *******************************************************
 * BY:MICH
 * *******************************************************
 */

add_role( 'personal_empresa', __( 'Personal Empresa' ),
	array(
    'read'         => true,  // true allows this capability
    'edit_posts'   => false,
    'delete_posts' => false,
	)
);

add_role( 'profesional', __( 'Profesional' ),
	array(
    'read'         => true,  // true allows this capability
    'edit_posts'   => false,
    'delete_posts' => false,
	)
);

add_role( 'Former', __( 'Former S&C' ),
	array(
    'read'         => true,  // true allows this capability
    'edit_posts'   => false,
    'delete_posts' => false,
	)
);

/*********************************************************
 * *******************************************************
 *  PERMISO A LOS GESTORES DE TIENDA PARA CREAR USUARIOS 
 * *******************************************************
 * BY:MICH
 * *******************************************************
 */

$role = get_role( 'editor' );
//$role->add_cap( 'create_users' );
$role->add_cap( 'manage_woocommerce' );
$role->add_cap( 'view_woocommerce_reports' );
$role->add_cap( 'read_shop_orders' );
$role->add_cap( 'edit_shop_orders' );

/* GESTOR DE LA TIENDA */
/* $role2 = get_role( 'shop_manager' );
$role2->add_cap( 'create_users' ); */
	
function multiselectRole($user) {
echo "<script>
jQuery('select#role').attr('multiple',true);
</script>";
}
add_action('show_user_profile', 'multiselectRole'); // editing your own profile
add_action('edit_user_profile', 'multiselectRole'); // editing another user
add_action('user_new_form', 'multiselectRole'); // creating a new user
add_action('personal_options_update', 'multiselectRole');
add_action('edit_user_profile_update', 'multiselectRole');
add_action('user_register', 'multiselectRole');