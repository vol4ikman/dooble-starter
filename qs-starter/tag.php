<?php
/**
 * Default tag template
 *
 * @package WordPress
 */

get_header(); ?>

	<section role="main">
		<h1>
		<?php
			esc_html_e( 'Tag Archive: ', 'html5blank' );
			echo single_tag_title( '', false );
		?>
		</h1>
	</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
