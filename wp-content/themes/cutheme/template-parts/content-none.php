<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package santa_cole
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title color-yellow"><?php esc_html_e( 'Nada Encontrado', 'santa-cole' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( '¿Listo para publicar su primer post? <a href="%1$s">Empiece aquí</a>.', 'santa-cole' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>

			<p><?php esc_html_e( 'Lo siento, pero nada coincide con los términos de búsqueda. Vuelva a intentarlo con algunas palabras clave diferentes.', 'santa-cole' ); ?></p>
			<?php
			

		else :
			?>

			<p><?php esc_html_e( 'Parece que no podemos encontrar lo que estás buscando. Quizás la búsqueda pueda ayudar.', 'santa-cole' ); ?></p>
			<?php
			

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
