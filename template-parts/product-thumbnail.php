<?php
/**
 * The template for displaying product image thumbnails on the shop page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy
 *
 * @package suffoca_six
 */
?>

<?php if ( has_post_thumbnail() ): 
	$thumbnail = get_post_thumbnail();
?>
<img srcset="<?php echo $thumbnail['sizes']['product-small']; ?> 300w,
			 <?php echo $thumbnail['sizes']['product-medium']; ?> 600w"
  			src="<?php echo $thumbnail['sizes']['product-medium']; ?> 600w"
  			alt="<?php echo $thumbnail['alt']; ?>" >

<?php endif; ?>