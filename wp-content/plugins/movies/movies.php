<?php
/*
Plugin Name:  movies Plugin
Plugin URI:   https://example.com/plugins/the-basics/
Description:  Basic WordPress Plugin Header Comment
Version:      20160911
Author:       WordPress.org
Author URI:   https://author.example.com/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  wporg
Domain Path:  /languages
*/
?>
<html>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</html>

<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

/*Custom Post type start*/
function cw_post_type_movies() {

    $supports = array(
        'title', // post title
        'editor', // post content
        'author', // post author
        'thumbnail', // featured images
        'excerpt', // post excerpt
        'custom-fields', // custom fields
        'comments', // post comments
        'revisions', // post revisions
        'post-formats', // post formats
    );

    $labels = array(
        'name' => _x('Movies', 'plural'),
        'singular_name' => _x('Movies', 'singular'),
        'menu_name' => _x('Movies', 'admin menu'),
        'name_admin_bar' => _x('Movies', 'admin bar'),
        'add_new' => _x('Add New', 'add new'),
        'add_new_item' => __('Add New movie'),
        'new_item' => __('New Movie'),
        'edit_item' => __('Edit Movie'),
        'view_item' => __('View Movie'),
        'all_items' => __('All Movie'),
        'search_items' => __('Search Movie'),
        'not_found' => __('No Movies found.'),
    );

    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'Movie'),
        'has_archive' => true,
        'hierarchical' => false,
    );
    register_post_type('movies', $args);
}
add_action('init', 'cw_post_type_movies');

/*Custom Post type end*/

function add_movies_metaboxes() {
    add_meta_box(
        'custom_movies_meta',
        'Movies meta info',
        'custom_movies_callback',
        'movies',
        'normal',
        'high'
    );
}

function custom_movies_callback(){
    global $post;
    // Nonce field to validate form request came from current site
    wp_nonce_field( basename( __FILE__ ), 'movies_nonce' );
    $genre = get_post_meta( $post->ID, 'genre', true );
    $actors = get_post_meta( $post->ID, 'actors', true );
    $rating = get_post_meta( $post->ID, 'rating', true );
    //var_dump($genre); die;
    // Output the field
    echo '<label>Actors:</label>'.
        '<input type="text" name="actors" 
        value="' .
        esc_textarea( $actors )  .
        '" class="widefat" >';

    echo '<label>Genre:</label>' .
        ' <select class="widefat"  name="genre" >
                                     <option value="action" '.($genre=="action"?"selected":"").'>action</option>
                                     <option value="drama" '.($genre=="drama"?"selected":"").'>drama</option>
                                     <option value="scifi" '.($genre=="scifi"?"selected":"").'>scifi</option>
                                     <option value="comedy" '.($genre=="comedy"?"selected":"").'>comedy</option>
                           </select>';

    echo '<label>Rating:</label>' . ' <select class="widefat"  name="rating"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), '."rating".', true ) ); ?>">
                             <option value="1" '.($rating=="1"?"selected":"").'>1</option>
                             <option value="2" '.($rating=="2"?"selected":"").'>2</option>
                             <option value="3" '.($rating=="3"?"selected":"").'>3</option>
                             <option value="4" '.($rating=="4"?"selected":"").'>4</option>
                             <option value="5" '.($rating=="5"?"selected":"").'>5</option>
                          </select>';
}

add_action( 'add_meta_boxes', 'add_movies_metaboxes' );

function save_meta_box( $post_id ) {
    if ( !wp_verify_nonce( $_POST['movies_nonce'], basename( __FILE__ ) ) )
        return $post_id;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( $parent_id = wp_is_post_revision( $post_id ) ) {
        $post_id = $parent_id;
    }
    $fields = [
        'actors',
        'genre',
        'rating',
    ];
    foreach ( $fields as $field ) {
        if ( array_key_exists( $field, $_POST ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
        }
    }
}
add_action( 'save_post', 'save_meta_box' );

function showrating($x){
    $rating='';
    for($i=1;$i<=$x;$i++){
        $rating.='<i class="fas fa-star"></i>';
    }
    for($i=1;$i<=(5-$x);$i++){
        $rating.='<i class="far fa-star"></i>';
    }
    return $rating;
}

function movies_shortcode ( $atts ) {

    $atts = shortcode_atts( array(
        'default' => ''
    ), $atts );
    $terms = get_terms('');
    wp_reset_query();
    $args = array('post_type' => 'movies'
    );
    $loop = new WP_Query($args);
    if($loop->have_posts()) {
        $output='';
        while($loop->have_posts()) : $loop->the_post();
            $id=get_the_ID();
            $title=get_the_title($id);
            $actors=get_post_meta($id,'actors');
            $genre=get_post_meta($id,'genre');
            $rating=get_post_meta($id,'rating');
            // var_dump($actors); die;
            $img=get_the_post_thumbnail_url($id);
            $output .= "<label>"."<a href=".get_permalink($id,false).">".$title."</a></label><br>".'<img src="'.$img.'" class="img-thumbnail"><br>'.
                "<label> Actors: ".$actors[0]."</label>"."<label> Ratings:</label> ".showrating($rating[0])."<hr>";
        endwhile;
        return $output;
    }
}
add_shortcode( 'movies','movies_shortcode' );

?>