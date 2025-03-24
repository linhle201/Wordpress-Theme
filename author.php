<?php
/* Template for Author pages */
get_header(); 
?>

<main id="author-page" class="author-page">

<div class="container my-5 custom-author-container">
    <!-- Author Container -->
    <div class="row author-container d-flex align-items-center">
        <!-- Display Author Profile Image (on the left) -->
        <div class="col-md-4 author-image d-flex justify-content-center">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 150, '', '', ['class' => 'img-fluid rounded-circle shadow-lg'] ); ?>
        </div>  

        <!-- Author Information Container (on the right) -->
        <div class="col-md-8 author-details">
            <!-- Wrap author name in anchor tag with 'author-link' class -->
            <p class="text-decoration-none fs-1 fw-bold" style="color: darkgreen;">
                <?php the_author(); ?>
            </p>
            <p class="author-email">
                <a href="mailto:<?php echo esc_attr( get_the_author_meta( 'user_email' ) ); ?>" class="text-decoration-none">
                    <?php echo esc_html( get_the_author_meta( 'user_email' ) ); ?>
                </a>
            </p>
            <p class="author-bio"><?php the_author_meta( 'description' ); ?></p>
        </div>
    </div>
</div>

    
    <div class="author-posts">
        <h2 style="color:darkgreen; font-weight:bold;text-align:center;"><?php echo esc_html( get_the_author() ); ?>'s Posts</h2>

        <?php
        // Author's posts query
        $args = array(
            'author' => get_the_author_meta( 'ID' ),
            'posts_per_page' => 10, 
        );
        $author_posts = new WP_Query( $args );

        if ( $author_posts->have_posts() ) : ?>
            <div class="post-list">
                <?php while ( $author_posts->have_posts() ) : $author_posts->the_post(); ?>
                    <div class="post-item">
                        <a href="<?php the_permalink(); ?>" class="post-link" style="text-decoration:none;">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="post-thumbnail">
                                    <?php the_post_thumbnail('medium', ['class' => 'img-fluid']); ?>
                                </div>
                            <?php endif; ?>

                            <h3 class="post-title"><?php the_title(); ?></h3>

                            <!-- Display Date and Categories below the title -->
                            <div class="post-meta">
                                <div class="post-date" style="color:black;">
                                    <i class="fas fa-calendar-alt"></i> <?php echo get_the_date(); ?>
                                </div>
                                <div class="post-categories">
                                    <i class="fas fa-tags" style="color:black;"></i> <?php the_category(', '); ?>
                                </div>
                            </div>

                            <div class="post-excerpt" style="font-size:0.8rem; color:black;">
                                <?php the_excerpt(); ?>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
            
            <!-- Pagination (if needed) -->
            <div class="pagination">
                <?php
                echo paginate_links( array(
                    'total' => $author_posts->max_num_pages
                ) );
                ?>
            </div>

        <?php else : ?>
            <p>No posts found by this author.</p>
        <?php endif; ?>
        
        <?php wp_reset_postdata(); ?>

    </div>
    
</main>



<?php get_footer(); ?>