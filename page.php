<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Suffoca_Six
 */

get_header(); ?>


	<?php while ( have_posts() ) : the_post(); ?>

		<?php if ( is_cart() ) {
						get_template_part( 'template-parts/content', 'checkout');
					}
					else if ( is_checkout() ) {
						get_template_part( 'template-parts/content', 'checkout');
					}
					else {
						get_template_part( 'template-parts/content', 'page' );
					}

		?>

		<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		?>

	<?php endwhile; // End of the loop. ?>


<?php get_footer(); ?>
