<?php
/**
 * The footer containing the load more widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Suffoca_Six
 */

if ( ! is_active_sidebar( 'footer-widget' ) ) {
	return;
}
?>

<footer id="load-more" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'footer-widget' ); ?>
</footer><!-- #secondary -->
