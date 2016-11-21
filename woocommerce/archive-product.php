<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<?php
	/*
	Loop through shop lookbook & intro page, and return images & text.
	 */
		query_posts(
			array(
				'page_id' => 16,
			)
		); ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<!-- Get featured image for shop, return as background image. -->
			<?php
			    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'featured');
			    $img_id = get_post_thumbnail_id( $post_id );
			    $alt_text = get_post_meta($post->ID, '_wp_attachment_image_alt', true);
			?>

			<!-- Show featured image and title -->
			<header id="shop-header">
				<div id="lookbook">
					<div class="pane" style="background-image:url(<?php echo $featured_image[0]; ?>)">
						<section>
							<h1 class="title"> <?php the_field('lookbook_title'); ?></h1>
						</section>

					</div>
					<?php
						$slide_video = get_field('lookbook_video_youtube_id');
						if (!empty ($slide_video)): ?>
							<div class="pane">
								<div class="fluid-width-video-wrapper height-100">
									<iframe width="640" height="360" src="https://www.youtube.com/embed/<?php echo $slide_video; ?>?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
								</div>
							</div>
					<?php endif; ?>
					<?php
						for ($x = 0; $x <= 12; $x++) {
								$slide_img = get_field('lookbook_image_'.$x.'');
								//echo '<p>slide exists</p>';
								$slide_img_url = $slide_img['url'];
								if (!empty ($slide_img)) {
									echo '<div class="pane" style="background-image:url('.$slide_img_url.');"> </div>' ;
								}
						}
					?>

				</div>


				<!-- End Lookbook -->
			</header>




			<!-- <section id="shop-intro">
			 php the_content();
			</section> -->

		<?php endwhile; endif; ?>
	<?php wp_reset_query(); ?>

	<div id="shop-archive-wrap">
		<?php
			/**
			 * woocommerce_before_main_content hook
			 *
			 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
			 * @hooked woocommerce_breadcrumb - 20
			 */
			do_action( 'woocommerce_before_main_content' );
		?>

			<?php if ( have_posts() ) : ?>

			<ul class="products">
				<?php woocommerce_product_loop_start(); ?>

					<?php woocommerce_product_subcategories(); ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
							$product_canvas_image = get_field('product_canvas_image');
							if (!empty ($product_canvas_image)):?>
							<li>
								<a href="<?php the_permalink(); ?>" class="woocommerce-LoopProduct-link">
									<img srcset="<?php echo $product_canvas_image['sizes']['shop_thumbnail']; ?> 300w,
											<?php echo $product_canvas_image['sizes']['shop_catalog']; ?> 600w,
											<?php echo $product_canvas_image['sizes']['shop_single']; ?> 1200w"
											sizes="…"
											src="<?php echo $product_canvas_image['sizes']['shop_catalog']; ?>"
											alt="…">
								</a>
							</li>
							<?php
						 else:
							 wc_get_template_part( 'content', 'productphoto' );
						endif;
						?>
					<?php endwhile; // end of the loop. ?>
				<?php woocommerce_product_loop_end(); ?>
			</ul>

			<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

				<?php wc_get_template( 'loop/no-products-found.php' ); ?>

			<?php endif; ?>
	</div>

<?php get_footer( 'shop' ); ?>
