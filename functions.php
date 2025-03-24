<?php
// Enqueue Bootstrap styles and scripts
function add_bootstrap() {
  wp_enqueue_style( 'bootstrap5Styles', "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css");
  wp_enqueue_script( 'bootstrap5Scripts', "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js", array(), false, true );
}
add_action('wp_enqueue_scripts', 'add_bootstrap');

// Register widget area (sidebar)
function add_widget_support() {
  register_sidebar( array(
    'name'          => 'Sidebar',
    'id'            => 'sidebar',
    'before_widget' => '<div class="sidebar">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'add_widget_support' );

// Add theme support for widgets
add_theme_support( 'widgets' );

// Register theme styles
function my_theme_enqueue_styles() {
  wp_enqueue_style('my-theme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

// Register custom navigation menu
function add_Main_Nav() {
  register_nav_menu('header-menu', __( 'Header Menu' ));
}
add_action( 'init', 'add_Main_Nav' );

// Add support for automatic feed links and post thumbnails
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );

// Custom pagination
function custom_pagination() {
  global $query;
  $big = 999999999; // need an unlikely integer
  $pagination = paginate_links( array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'total' => $query->max_num_pages,
    'current' => max( 1, get_query_var( 'paged' ) ),
    'format' => '?paged=%#%',
    'show_all' => false,
    'type' => 'array',
    'end_size' => 2,
    'mid_size' => 1,
    'prev_next' => true,
    'prev_text' => __('&laquo; Previous'),
    'next_text' => __('Next &raquo;'),
    'add_args' => false,
    'add_fragment' => '',
  ) );
  if ( is_array( $pagination ) ) {
    echo '<ul class="pagination">';
    foreach ( $pagination as $page ) {
      echo '<li class="page-item"><span class="page-link" href="#">' . $page . '</span></li>';
    }
    echo '</ul>';
  }
}

// Enable block templates for Full Site Editing (FSE)
add_theme_support('block-templates');

// Set the excerpt length
function custom_excerpt_length($length) {
  return 30; // Adjust the number (default is 55) to the desired word count for the excerpt
}
add_filter('excerpt_length', 'custom_excerpt_length');

function add_font_awesome() {
  wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css' );
}
add_action( 'wp_enqueue_scripts', 'add_font_awesome' );

function display_related_posts_function() {
  // Get the tags of the current post
  $tags = get_the_tags();

  if ($tags) {
      // Create an array to hold the tag IDs
      $tag_ids = array();

      // Loop through the tags and get the IDs
      foreach ($tags as $tag) {
          $tag_ids[] = $tag->term_id;
      }

      // Set up the query to fetch posts with the same tags
      $args = array(
          'tag__in' => $tag_ids, // Filter by these tags
          'post__not_in' => array(get_the_ID()), // Exclude the current post
          'posts_per_page' => 5, // Limit to 5 posts
          'ignore_sticky_posts' => 1 // Avoid sticky posts
      );

      // Query for related posts
      $related_posts = new WP_Query($args);

      if ($related_posts->have_posts()) :
          echo '<div class="related-posts">';
          echo '<h2>Related Posts</h2>';
          echo '<ul>';

          // Loop through the related posts and display them
          while ($related_posts->have_posts()) : $related_posts->the_post();
              echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
          endwhile;

          echo '</ul>';
          echo '</div>';
      endif;

      // Reset postdata
      wp_reset_postdata();
  }
}

// Hook into 'display_related_posts' to call this function
add_action('display_related_posts', 'display_related_posts_function');

// In your plugin file
function my_custom_related_posts() {
  // This is where we will display the related posts
  do_action('display_related_posts'); // Triggering the action hook
}
add_action('wp_footer', 'my_custom_related_posts');





