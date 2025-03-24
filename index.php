<?php
/* Template for single post pages */
get_header(); 
?>

<main class="single-post container mt-4">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <!-- Author Avatar and Name -->
  <div class="d-flex align-items-center mb-3">
    <!-- Avatar and Author Name linked to the Author's page -->
    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="d-flex align-items-center text-decoration-none">
        <!-- Avatar with Bootstrap utilities for border and rounded circle -->
        <div class="avatar-wrapper position-relative" style="position: relative;">
            <?php echo get_avatar(get_the_author_meta('ID'), 64, '', '', ['class' => 'img-fluid border border-2 border-dark rounded-circle']); ?> <!-- Avatar -->

            <div class="author-hover-info position-absolute bg-white p-3 rounded-3" 
            style="display: none; top: 100%; left: 0; width: 300px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); z-index: 10; border-radius: 10px; border: 1px solid #ddd;">
                <!-- Author Avatar and Name (on the top row) -->
                <div class="d-flex mb-2">
                    <!-- Avatar inside bubble on the top-left -->
                    <div class="me-3">
                        <?php echo get_avatar(get_the_author_meta('ID'), 64, '', '', ['class' => 'img-fluid border border-2 border-dark rounded-circle']); ?>
                    </div>

                    <!-- Author Name, Username, and Recent Posts on the right -->
                    <div class="d-flex flex-column">
                        <!-- Author Name on top with smaller font size -->
                        <p class="fw-bold mb-0" style="color: darkgreen; font-size: 14px;"><?php the_author(); ?></p>
                        
                        <!-- Author Username under the Author Name with smaller font size -->
                        <p class="mb-0" style="color: gray; font-size: 12px;"><?php echo get_the_author_meta('user_login'); ?></p>

                        <!-- Recent Posts (Stacked below the avatar and name) -->
                        <div class="mt-3">
                            <div class="row g-2">
                                <?php
                                // Fetch the 3 most recent posts by the author
                                $recent_posts = new WP_Query(array(
                                    'author' => get_the_author_meta('ID'),
                                    'posts_per_page' => 3,
                                ));

                                if ($recent_posts->have_posts()) :
                                    while ($recent_posts->have_posts()) : $recent_posts->the_post();
                                        ?>
                                        <div class="col-4 mb-2">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <div class="post-thumbnail" style="height: auto; width:100%; overflow: hidden;">
                                                    <?php the_post_thumbnail('thumbnail', ['class' => 'img-fluid', 'style' => 'object-fit: cover; width: 100%; height: 100%;']); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <?php
                                    endwhile;
                                endif;
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- View Profile Button (inside the hover bubble) -->
                <div>
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="btn btn-sm btn-outline-dark w-100" style="font-weight: bold;">
                        View Profile
                    </a>
                </div>
            </div>
        </div>

        <!-- Author Name -->
        <div class="ms-3">
            <p class="mb-0" style="color: darkgreen; font-weight: bold;"><?php the_author(); ?></p>
        </div>
    </a>
</div>


    <div class="post-content">
        <!-- Post Thumbnail -->
        <div class="post-thumbnail">
            <?php if (has_post_thumbnail()) : ?>
                <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>" class="img-fluid">
            <?php endif; ?>
        </div>

        <!-- Post Title and Meta -->
        <h1><?php the_title(); ?></h1>
        <p class="post-meta">
            By: <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="text-decoration-none"><?php the_author(); ?></a> 
            | <?php the_date(); ?> 
            | <?php the_category(', '); ?>
        </p>

        <!-- Post Content -->
        <div class="post-body">
            <?php the_content(); ?>
        </div>

        <!-- Display related posts or other content here -->
        <?php do_action('display_related_posts'); ?>
    </div>

    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>

<!-- Inline JavaScript for hover effect -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var avatarWrapper = document.querySelector('.avatar-wrapper');
        var hoverInfo = document.querySelector('.author-hover-info');
        
        // Show the hover bubble when hovering over the avatar wrapper
        avatarWrapper.addEventListener('mouseenter', function() {
            hoverInfo.style.display = 'block';
        });

        // Hide the hover bubble when mouse leaves the avatar wrapper
        avatarWrapper.addEventListener('mouseleave', function() {
            hoverInfo.style.display = 'none';
        });
    });
</script>