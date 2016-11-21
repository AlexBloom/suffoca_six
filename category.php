<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Suffoca_Six
 */

get_header(); ?>

<?php
	/*
	Loop through 1 sticky post and return in full-bleed header layout.
	 */
query_posts(
	array(
		'posts_per_page' => 1,
		'post__in' => get_option( 'sticky_posts' ),
	)
); ?>
<!-- outer container -->
<header class="enllax-container" data-enllax-ratio="-.5" data-enllax-type="foreground">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		 <?php
				$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large');
				$img_id = get_post_thumbnail_id( $post_id );
				$alt_text = get_post_meta($post->ID, '_wp_attachment_image_alt', true);
		?>
		<!-- inner container -->
		<a href="<?php the_permalink(); ?>" id="home-header" class="page-header" style="background-image:url(<?php echo $featured_image[0]; ?>)" alt="<?php echo $alt_text ?>">

			<div id="post-title" data-enllax-ratio="1" data-enllax-type="fade" data-enllax-direction="null" data-enllax-fade="true" class="post-title">
				<h1 class="title"> <?php the_title(); ?> </h1>
				<h2 class="subtitle"> <?php the_field('subtitle'); ?> </h2>

			</div>
		<!-- end inner container -->
		</a>
	<?php endwhile; endif; ?>

<!-- end outer container -->
</header>
<?php wp_reset_query(); ?>

	<div id="home-posts" class="page-content">

			<?php wp_nav_menu(
				array(
					'menu' => 'filters',
					//'container' => '',
					//'container_class' => 'filters',
					'items_wrap' => '<ul id="%1$s" class="filters">%3$s</ul>',
				)
    		); ?>



		<?php if (have_posts()) : ?>

		<ul class="posts category-view">
			 <?php while (have_posts()) : the_post(); ?>
				<?php
				    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium');
				    $img_id = get_post_thumbnail_id( $post_id );
				    $alt_text = get_post_meta($post->ID, '_wp_attachment_image_alt', true);
				?>
				<li style="background-image:url(<?php echo $featured_image[0]; ?>)">

			     	<a href="<?php the_permalink(); ?>" class="permalink">
		     			<h3> <?php the_title(); ?> </h3>
			     	</a>

		     	</li>

			<?php endwhile; ?>
		</ul>

		<?php dynamic_sidebar( 'footer-widget' ); ?>

	<?php else: ?>
		<?php get_template_part( 'template-parts/content', 'none' ); ?>
	<?php endif; ?>


</div>


<?php get_footer(); ?>
