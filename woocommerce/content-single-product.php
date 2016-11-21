<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>


<article itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" class="product">


	<header>
				<section class="product-info">
					<h2 itemprop="name" class="product_title entry-title"><?php the_title(); ?></h2>

					<div class="description" itemprop="description">
						<?php $heading = esc_html( apply_filters( 'woocommerce_product_description_heading', __( 'Product Description', 'woocommerce' ) ) );
						?>

						<?php if ( $heading ): ?>
							<!-- <p> <strong> <?php //echo $heading; ?> </strong> </p> -->
						<?php endif; ?>

						<?php the_content(); ?>

					</div>

					<div itemprop="offers">
						<h6 class="price"> <strong> <?php echo $product->get_price_html(); ?> </strong> </h6>
						<meta itemprop="price" content="<?php echo esc_attr( $product->get_price() ); ?>" />
						<meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />
						<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />
					</div>
					<div id="product-selections">

						<?php
						 // Remove the things we don't need from the default "Single Product Summary" because we're manually adding them in other layouts.

						 remove_action('woocommerce_single_product_summary','woocommerce_template_single_title',5);
						 remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating',10);
						 remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10);
						 remove_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt',20);
						 remove_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',30);
						 remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);
						 remove_action('woocommerce_single_product_summary','woocommerce_template_single_sharing',50);

						 add_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',1);

						 do_action('woocommerce_single_product_summary');


						?>

						<p class="open-size-chart"><small>Sizing Chart</small></p>


					</div>
				</section>
				<div class="featured-image">
							<?php
								if ( has_post_thumbnail() ) {
									$image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
									$image_link    = wp_get_attachment_url( get_post_thumbnail_id() );
									$image         = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
										'title'	=> get_the_title( get_post_thumbnail_id() )
									) );

									$gallery = '';

									echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="'.$image_caption.'" />', $image_link, $image ), $post->ID );


								} else {

									echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );

								}
							?>


				</div>
	</header>
	<!-- end info slide -->


	<div class="product-slider">

		<!-- call and repeat product slide images here -->
			<?php
				for ($x = 0; $x <= 5; $x++) {
						$product_img = get_field('product_img_'.$x.'');
						$product_img_url = $product_img['url'];
						if (!empty ($product_img)) {
							echo '<div class="" style="background-image:url('.$product_img_url.');"> </div>' ;
						}
				}
			?>
	</div>
		<!-- end of slider -->
		<section class="size-chart">
			<span class="close-size-chart">
					<svg class="icon icon-close">
						<use xlink:href="#icon-close"></use>
					</svg>
			</span>
			<div class="size-chart-float">
				<img src="<?php bloginfo('template_directory'); ?>/img/sizechart.png" alt="Sizechart" />
			</div>
		</section>

		<h6>
			<a href="shop" id="back-to-shop">Back to Shop</a>
		</h6>




	<!-- <meta itemprop="url" content="<?php the_permalink(); ?>" /> -->

</article><!-- #product-<?php the_ID(); ?> -->
