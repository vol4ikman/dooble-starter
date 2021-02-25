<?php
/**
 * Search page template
 *
 * @package WordPress
 */

get_header(); ?>

	<section role="main">
		<h1>
		<?php
			echo sprintf( __( '%s Search Results for ', 'html5blank' ), esc_html( $wp_query->found_posts ) );
			echo get_search_query();
		?>
		</h1>

		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article>
				<h3><?php the_title(); ?></h3>
			</article>
		<?php endwhile; ?>
	</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
