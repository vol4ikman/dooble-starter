<?php
/**
 * WooCommerce main functions
 *
 * @package WordPress
 */

/**
 * This function will return ranges of prices between product least and most expensive
 * @return [type] [description]
 */
function get_price_range() {
	global $wpdb;

	$category_id = get_queried_object_id();

	$sql_fregments = array();

	$sql_fregments[] = "SELECT MAX( CAST( pm.meta_value as INT ) ) as max , MIN( CAST( pm.meta_value as INT ) ) as min
            FROM {$wpdb->posts} posts
            JOIN {$wpdb->postmeta} pm
            ON pm.post_id = posts.ID";

	if ( $category_id ) {
		$sql_fregments[] = "JOIN {$wpdb->term_relationships} rel
                            ON posts.ID = rel.object_id";
	}

	$sql_fregments[] = "WHERE post_type = 'product'";

	if ( $category_id ) {
		$sql_fregments[] = "AND rel.term_taxonomy_id = '{$category_id}'";
	}

	$sql_fregments[] = "AND post_status = 'publish'
                        AND pm.meta_key = '_price'";

	$sql = implode( ' ', $sql_fregments );

	$results = $wpdb->get_row( $sql, ARRAY_A ); //phpcs:ignore.

	$max = $results['max'];
	$min = $results['min'];

	$step = $max - $min;
	for ( $i = 5;$i > 0; $i++ ) {
		if ( $step / 5 > 10 ) {
			$step = ceil( $step / 5 );
			break;
		}
	}
	$ranges = range( $min, $max, $step );

	return $ranges;
}

/**
 * This function will return a list of attributes of products in a certain category
 *
 * @param  string $category_id category ID.
 * @param  string $taxonmoy    taxonomy.
 * @return [type]              [description]
 */
function get_filter( $category_id, $taxonmoy ) {
	global $wpdb;
	$sql = "SELECT rel2.term_taxonomy_id as term_id , wptt.taxonomy , count( DISTINCT rel.object_id ) as count , wpt.name as name
    FROM {$wpdb->posts} posts
    JOIN {$wpdb->term_relationships} rel
    ON posts.ID = rel.object_id
    JOIN {$wpdb->term_relationships} rel2
    ON posts.ID = rel2.object_id
    JOIN {$wpdb->term_taxonomy} wptt
    ON wptt.term_id = rel2.term_taxonomy_id
    JOIN {$wpdb->terms} wpt
    ON wpt.term_id = rel2.term_taxonomy_id
    WHERE post_type = 'product'
    AND rel.term_taxonomy_id = '{$category_id}'
    AND post_status = 'publish'
    AND wptt.taxonomy = '{$taxonmoy}'
    GROUP BY rel2.term_taxonomy_id";

	$results = $wpdb->get_results( $sql, ARRAY_A ); //phpcs:ignore.

	return $results;
}
