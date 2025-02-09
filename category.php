<?php
/* Template for Category Pages */
get_header();

$category = get_queried_object(); 
?>

<main class="category-page container mt-4">
    <h1> <?php echo esc_html($category->name); ?></h1>

    <div class="row">
        <?php
        // Set up query to get all posts from the current category
        $args = array(
            'cat' => $category->term_id, 
            'posts_per_page' => -1, // Show all posts (or change the number for pagination)
        );
        $category_query = new WP_Query($args);

        // Check if posts exist and display them
        if ($category_query->have_posts()) :
            while ($category_query->have_posts()) : $category_query->the_post();
        ?>
            <div class="col-md-4 mb-4"> <!-- 3 columns per row -->
                <article class="post-item">
                    <!-- Post Featured Image -->
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium', ['class' => 'img-fluid']); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <!-- Post Title -->
                    <h2><a href="<?php the_permalink(); ?>" style="text-decoration: none;color:darkgreen;"><?php the_title(); ?></a></h2>

                    <!-- Post Author Name -->
                    <p>By: <?php the_author(); ?></p>

                    <!-- Post Date -->
                     <p><?php the_date(); ?></p> 
                </article>
            </div>
        <?php
            endwhile;
        else :
            echo '<p>No posts found in this category.</p>';
        endif;

        wp_reset_postdata(); 
        ?>
    </div>
</main>
<?php get_footer(); ?>

</body>
</html>