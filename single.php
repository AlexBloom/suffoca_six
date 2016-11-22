<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Suffoca_Six
 */

get_header(); ?>


	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" class="post">
			<?php get_template_part( 'template-parts/content', 'single' ); ?>

		<!-- 	<footer>
				<section id="comments" class="comments">
						// If comments are open or we have at least one comment, load up the default comment template provided by Wordpress
						// if ( comments_open() || '0' != get_comments_number() )
						// comments_template( '', true );
				</section>
			</footer>-->

		</article>
		<!-- pagination -->
		<div class="pagination">
			<?php
			$prev_post = get_previous_post();
			if (!empty( $prev_post )): ?>
				<?php
				    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $prev_post->ID ), 'featured');
				    $img_id = get_post_thumbnail_id( $prev_post_id );
				    $alt_text = get_post_meta($prev_post->ID, '_wp_attachment_image_alt', true);
						$prev_subtitle = get_field('subtitle', $prev_post);
				?>
		  		<a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="next-up slide-in-bg enllax-container" style="background-image:url( <?php echo $featured_image[0]; ?> )">
		  			<h6> NEXT UP </h6>
		  			<h1 class="next-post-title">
		  				<?php echo $prev_post->post_title; ?>
		  			</h1>
						<?php if(!empty ($prev_subtitle )): ?>
							<p class="subtitle"> <?php echo $prev_subtitle; ?> </p>
						<?php endif; ?>
		  		</a>
			<?php endif; ?>
		</div><!-- pagination -->

	<?php endwhile; // End of the loop. ?>

	<?php get_template_part('email','subscribe'); ?>

<?php get_footer(); ?>
