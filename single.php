<?php get_header( )?>
<?php 
    while(have_posts())
    {
      the_post(); ?>
      <div style="height: 500px; width: 75%; margin: auto; display: flex; justify-content: center; align-items: center;">
        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
        <h1 style="display: inline-block !important"> <?php the_title() ?> by <?php  echo get_author_name( ) ?>  </h1>
        <p style="display: inline-block !important ; color: black !important;"><?php the_content()?></p> 
        </div>
      
      </div>
     
      
    <?php }
   ?>
