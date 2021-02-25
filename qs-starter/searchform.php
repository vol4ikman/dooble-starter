<?php
/**
 * Default search form template
 *
 * @package WordPress
 */

?>
<form class="search" method="get" action="<?php echo esc_url( home_url() ); ?>" role="search">
	<input class="search-input" type="search" name="s" placeholder="To search, type and hit enter.">
	<button class="search-submit" type="submit" role="button"><?php esc_html_e( 'Search', 'html5blank' ); ?></button>
</form>
