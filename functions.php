<?php
// This function enqueues the Normalize.css for use. The first parameter is a name for the stylesheet, the second is the URL. Here we
// use an online version of the css file.
// function add_normalize_CSS() {
//    wp_enqueue_style( 'normalize-styles', "https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css");
// }

// add_action('wp_enqueue_scripts', 'add_normalize_CSS');
function add_bootstrap() {
  wp_enqueue_style( 'bootstrap5Styles', "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css");
  wp_enqueue_script( 'bootstrap5Scripts', "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js",array(), false, true );
}

add_action('wp_enqueue_scripts', 'add_bootstrap');

// Register a new sidebar simply named 'sidebar'
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
// Hook the widget initiation and run our function
add_action( 'widgets_init', 'add_widget_support' );

function my_theme_enqueue_styles() {
  wp_enqueue_style('my-theme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

// Register a new navigation menu
function add_Main_Nav() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
// Hook to the init action hook, run our navigation menu function
add_action( 'init', 'add_Main_Nav' );

add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );

function custom_pagination() {
  global $query;
  $big = 999999999; // need an unlikely integer
  $pagination = paginate_links( array(
  'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link(
  $big ) ) ),
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
  echo '<li class="page-item"><span class="page-link" href="#">' .
  $page . '</span></li>';
  }
  echo '</ul>';
  }
  }
  function custom_excerpt_length($length) {
    return 30; // Adjust the number (default is 55) to the desired word count for the excerpt
}
add_filter('excerpt_length', 'custom_excerpt_length');