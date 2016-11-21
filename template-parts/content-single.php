<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Suffoca_Six
 */

?>


	<header class="enllax-container" data-enllax-ratio="-.5" data-enllax-type="foreground">
		<?php
		    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'featured');
		    $img_id = get_post_thumbnail_id( $post_id );
		    $alt_text = get_post_meta($post->ID, '_wp_attachment_image_alt', true);
		?>
		<div class="page-header"  style="background-image:url(<?php echo $featured_image[0]; ?>)">
			<div class="post-title">
		        <h1 class="title"><?php the_title(); ?></h1>
		        <p class="subtitle"><?php the_field('subtitle') ?></p>
			</div>
    </div>
	</header>
	<section class="post-content page-content">
		<?php get_template_part('template-parts/nav','share'); ?>
		<?php the_content(); ?>
	</section>
