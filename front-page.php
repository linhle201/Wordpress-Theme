<?php /* Template Name: Front page template */ ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?> &raquo; <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>">
    <?php wp_head(); ?> 
</head>

<body <?php body_class(); ?>>

<header class="my-logo">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo home_url(); ?>">The Wave</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php wp_nav_menu(array(
                    'theme_location' => 'header-menu',
                    'menu_class' => 'navbar-nav ms-auto',
                    'container' => false,
                    'depth' => 2,
                    'fallback_cb' => false,
                )); ?>
            </div>
        </div>
    </nav>
</header>

<main class="container mt-4">
    <div class="row">
        <?php
        // Query for each category
        $categories = get_categories();
        foreach ($categories as $category) :
            // Display Category Name
            echo '<h2 class="category-h">' . $category->name . '</h2>';

            // Query for the latest 4 posts in the category
            $args = array(
                'category_name' => $category->slug,
                'posts_per_page' => 4,
            );
            $category_query = new WP_Query($args);

            if ($category_query->have_posts()) :
                // Column 1: Display the first post (Featured Post with Image and Content)
                $category_query->the_post();
                ?>
                <div class="col-md-7 mb-4"> 
                    <article class="featured-post">
                        <a href="<?php the_permalink(); ?>" style="text-decoration: none !important;">
                            <!-- Display Featured Image (Thumbnail) -->
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail">
                                    <?php the_post_thumbnail('medium', ['class' => 'img-fluid']); ?>
                                </div>
                            <?php endif; ?>
                            <h3><?php the_title(); ?></h3>
                        </a>
                        <p>By: <?php the_author(); ?></p>
                        <p><?php the_excerpt(); ?></p> 
                    </article>
                </div>

                <!-- Column 2: Display the next 3 posts in 2-column layout (Image + Content) -->
                <div class="col-md-5">
                    <div class="container">
                        <?php
                        // Display the next 3 posts (with images)
                        $count = 0;
                        while ($category_query->have_posts() && $count < 3) :
                            $category_query->the_post();
                        ?>
                            <div class="post-container row mb-1">
                                <!-- Image-->
                                <div class="col-md-6 mb-3">
                                    <div class="smallpost-thumbnail">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('small', ['class' => 'img-fluid']); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="col-md-6">
                                    <div class="post-content">
                                        <h4><a href="<?php the_permalink(); ?>" style="text-decoration: none;"><?php the_title(); ?></a></h4>
                                        <p>By: <?php the_author(); ?></p>
                                        <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>     
                                    </div>
                                </div>
                            </div>
                        <?php
                            $count++;
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>

            <?php endif; endforeach; ?>
    </div>
</main>

<?php get_footer(); ?>

</body>
</html>