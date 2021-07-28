<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();?>
<div class="banner">
<h1>Help</h1>
</div>
		<div class="container">
            <div class="blogSearch">
                <?php echo get_search_form(); ?>
            </div>


<div class="flexCol">
<?php $categories = get_categories( array(
    'orderby' => 'name',
    'parent'  => 0
) );
 
foreach ( $categories as $category ) {
    printf( '<a href="%1$s"><img src="'.z_taxonomy_image_url($category->term_id).'">%2$s</a>',
        esc_url( get_category_link( $category->term_id ) ),
        esc_html( $category->name )
    );
} ?>
</div>
 

<?php /* if ( have_posts() ) {

	// Load posts loop.
	while ( have_posts() ) {
		the_post();

		get_template_part( 'template-parts/content/content', get_theme_mod( 'display_excerpt_or_full_post', 'excerpt' ) );
	}

	// Previous/next page navigation.
	twenty_twenty_one_the_posts_navigation();

} else {

	// If no content, include the "No posts found" template.
	get_template_part( 'template-parts/content/content-none' );

} */ ?> 

<?php
get_footer();
