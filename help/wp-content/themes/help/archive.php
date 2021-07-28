<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

//$description = get_the_archive_description();
?>


<?php if ( have_posts() ) : ?>

		<div class="banner">
		<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
		<!-- <?php // if ( $description ) : ?>
			<div class="archive-description"><?php // echo wp_kses_post( wpautop( $description ) ); ?></div>
		<?php // endif; ?> -->
		</div><!-- .page-header -->

	<div class="container">
		
			<div class="blogSearch">
                <?php echo get_search_form(); ?>
            </div>
		<div class="questionList">
				
					
				<?php $cat = get_category( get_query_var( 'cat' ) );
				$cat_id = $cat->cat_ID;
				$child_categories=get_categories(
					array( 'parent' => $cat_id )
				);

				foreach ( $child_categories as $child ) { ?><div class="listView">
				<div class="listViewHead">
					<img src="<?php echo z_taxonomy_image_url($child->term_id); ?>" />
					<?php echo $child ->cat_name; ?>
				</div>

				<?php
			// the query
			$all_posts = new WP_Query( array( 'post_type' => 'post','category_name' => $child->name, 'post_status' => 'publish', 'posts_per_page' => -1 ) );

			if ( $all_posts->have_posts() ) :
			?>

			<ul>
				<?php while ( $all_posts->have_posts() ) : $all_posts->the_post(); ?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
			</ul>

			<?php endif; ?>


			</div>
				
				<?php
				
				}?>

			




		</div>
	</div>

	

<?php else : ?>
	<?php get_template_part( 'template-parts/content/content-none' ); ?>
<?php endif; ?>


<?php get_footer(); ?>
