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

<div class="pin-container">

<?php

// Get 50 random photos to display on home page
$featured = get_posts(array(
    'numberposts' => 50,
    'post_status' => 'publish',
    'orderby' => 'rand')
);

// Ouput each photo
foreach($featured as $fp){
    $photo_src = get_the_post_thumbnail_url($fp->ID, 'large');
    $post_url = get_permalink($fp->ID);
    $author_name =  get_the_author_meta('display_name', $fp->post_author);
    $avatar_src = get_avatar_url($fp->post_author);  
    $author_url = get_author_posts_url($fp->post_author);
    ?>

<div class="pin-box">
    <a href="<?= $post_url ?>"></a>
    <img src="<?= $photo_src ?>" alt="Post Image">
    <div class="pin-caption">
        <!-- Author Avatar -->
        <div class="author-avatar-container">
            <img class="author-avatar" src="<?= $avatar_src ?>" />
        </div>
        <div class="author-name"><?= $author_name ?></div>

        <!-- Author info container (hidden by default) -->
        <div class="author-info" data-author-id="<?= $fp->post_author ?>">
            <div class="author-container">
                <div class="author-image">
                    <?= get_avatar($fp->post_author, 150); ?>
                </div>
                <div class="author-details">
                    <h1 class="author-name"><?= $author_name ?></h1>
                    <p class="author-email">
                        <a href="mailto:<?php echo esc_attr(get_the_author_meta('user_email', $fp->post_author)); ?>">
                            <?php echo esc_html(get_the_author_meta('user_email', $fp->post_author)); ?>
                        </a>
                    </p>
                    <p class="author-bio"><?= get_the_author_meta('description', $fp->post_author); ?></p>

                    <div class="author-posts">
                        <h4>Recent Posts:</h4>
                        <ul>
                            <?php
                            // Get 3 most recent posts from the author
                            $recent_posts = get_posts(array(
                                'author' => $fp->post_author,
                                'numberposts' => 3,
                                'orderby' => 'date',
                                'order' => 'DESC',
                            ));
                            foreach ($recent_posts as $post) :
                                ?>
                                <li><a href="<?= get_permalink($post->ID); ?>"><?= get_the_title($post->ID); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="author-profile-link">
                        <a href="<?= get_author_posts_url($fp->post_author); ?>">View Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
?>

</div><!-- ./pin-container -->

<?php get_footer(); ?>

</body>
</html>

