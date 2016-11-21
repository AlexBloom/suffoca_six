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

	<?php
	/*
	Loop through 9 non-sticky posts and return in grid layout.
	 */
		query_posts(
			array(
				'posts_per_page' => 9,
				'post__not_in' => get_option( 'sticky_posts' ),
			)
		); ?>
	<?php if (have_posts()) : ?>

	<div id="home-posts" class="page-content">

			<?php wp_nav_menu(
				array(
					'menu' => 'filters',
					//'container' => '',
					//'container_class' => 'filters',
					'items_wrap' => '<ul id="%1$s" class="filters">%3$s</ul>',
				)
    		); ?>

		<ul class="posts">
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
		<section class="insta-video-wrap">
			<div class="instawrap">
				<div class="insta-content">
					<div id="instafeed">
						<?php dynamic_sidebar( 'insta-widget' ); ?>
					</div>
					<h3 class="instatitle">
						<a href="http://instagram.com/suffoca"target=_blank>Instagram Feed</a>
					</h3>
				</div>
			</div>

			<?php
				// ABOUT PAGE CONTENT
				$query_home = new WP_Query(
					array(
						'page_id' => 8032
					)
				);
			?>
			<?php if ( $query_home->have_posts() ) : while ( $query_home->have_posts() ) : $query_home->the_post(); ?>
				<?php
					$youtube_id = get_field('home_youtube_video_id');
					if( !empty($youtube_id) ):
				?>

				<div class="video-module">
					<iframe id="ytplayer" class="background-video" width="640" height="360" src="https://www.youtube.com/embed/<?php echo $youtube_id ?>?autoplay=1&amp;controls=0&amp;modestbranding=1&amp;rel=0&amp;showinfo=0&amp;enablejsapi=1" frameborder="0" allowfullscreen></iframe>
					<script>
					   // 2. This code loads the IFrame Player API code asynchronously.
				      var tag = document.createElement('script');

				      tag.src = "https://www.youtube.com/iframe_api";
				      var firstScriptTag = document.getElementsByTagName('script')[0];
				      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

				      // global variable for the player
						var player;
						// this function gets called when API is ready to use
						function onYouTubeIframeAPIReady() {
						  // create the global player from the specific iframe (#video)
						  player = new YT.Player('ytplayer', {
						    events: {
						      'onReady': onPlayerReady
						    }
						  });
						}
						function onPlayerReady(event) {
						  player.mute();
						  player.setVolume(0);
						}
					</script>
				</div>

			<?php endif; ?>

			<?php wp_reset_postdata(); ?>
			<?php endwhile; endif; ?>

		</section>
		<?php dynamic_sidebar( 'footer-widget' ); ?>
	</div>

	<?php else: ?>
		<?php get_template_part( 'template-parts/content', 'none' ); ?>
	<?php endif; ?>


<?php get_footer(); ?>
