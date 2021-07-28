<?php
/**
 * Template part for displaying post archives and search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<ul>
<?php
$post_format = get_post_format();
if ( 'aside' === $post_format || 'status' === $post_format ) {
	return;
}
the_title( sprintf( '<li><a href="%s">', esc_url( get_permalink() ) ), '</a></li>' );
twenty_twenty_one_post_thumbnail();
?>
</ul>
	<?php // get_template_part( 'template-parts/header/excerpt-header', get_post_format() ); ?>

	<!-- <div class="entry-content">
		<?php // get_template_part( 'template-parts/excerpt/excerpt', get_post_format() ); ?>
	</div>

	<footer class="entry-footer default-max-width">
		<?php // twenty_twenty_one_entry_meta_footer(); ?>
	</footer>-->
</article><!-- #post-${ID} -->
