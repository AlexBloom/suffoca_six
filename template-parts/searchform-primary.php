<?php
/**
 * The template for displaying the search form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy
 *
 * @package Suffoca_Six
 */
?>


<form  id="search" role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<label class="visuallyhidden">
		<span class="screen-reader-text"><?php echo _x( 'Search', 'label' ) ?></span>
	</label>
	<input type="search" class="search-field search-text-field" placeholder="<?php echo esc_attr_x( 'SEARCH', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search', 'label' ) ?>" />

</form>
