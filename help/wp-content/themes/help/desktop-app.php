<?php /* Template Name: Desktop Template */ ?>

<?php get_header();?>
<div class="banner">
<h1>Help</h1>
</div>

<div class="container">

    <div class="blogSearch">
        <?php echo get_search_form(); ?>
    </div>

    <div class="questionList">

    <?php
		$categories = get_categories();
		foreach($categories as $category) {?>
            <div class="listViewHead">
                <img src="<?php echo z_taxonomy_image_url($category->term_id); ?>" />
                <?php echo $category->name; ?>
            </div>
    
    <?php } ?>  
    </div>
    
</div>



<?php get_footer();?>