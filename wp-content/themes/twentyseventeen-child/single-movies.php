<?php  get_header(); ?>

<?php

function showratings($x){
    $rating='';
    for($i=1;$i<=$x;$i++){
        $rating.='<i class="fas fa-star"></i>';
    }
    for($i=1;$i<=(5-$x);$i++){
        $rating.='<i class="far fa-star"></i>';
    }
    return $rating;
}

    if ( have_posts() ) :
        while ( have_posts() ) : the_post(); ?>
           <h1> <?php the_title(); ?> </h1> <br>
            <?php the_post_thumbnail('large'); ?>
            <?php the_content(); ?>
            <?php $rating=get_post_meta($id,'rating');
            echo "<label> Ratings:</label>".showratings($rating[0]);
            ?>
    <?php   endwhile;
    endif;
?>

<?php get_footer(); ?>