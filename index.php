<?php
/* Template for single post pages */
get_header(); 
?>

<main class="single-post container mt-4">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="post-content">
            
            
            <div class="post-thumbnail">
                <?php if (has_post_thumbnail()) : ?>
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="img-fluid">
                <?php endif; ?>
            </div>
            <h1 style="color:darkgreen; font-size: 1.7rem; margin-top:20px; font-weight:bold;"><?php the_title(); ?></h1>
            <div class="post-meta">
                <p>By: <?php the_author(); ?> | <?php the_date(); ?> | <?php the_category(', '); ?></p>
            </div>

            <div class="post-body">
                <?php the_content(); ?> 
            </div>
        </div>
    <?php endwhile; endif; ?>
</main>
<?php get_footer(); ?>
