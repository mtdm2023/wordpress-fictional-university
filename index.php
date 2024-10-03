 <?php get_header()?>

<div style="width:75%; margin: auto; height: 200px; background-color: burlywood;" class="d-flex flex-column justify-content-center align-items-center">
 
   
 
</div>

  <?php 
    while(have_posts())
    {
      the_post(); ?>
      <div style="width: 75%; margin: auto; margin-top: 20px !important; text-wrap: nowrap;">
       <h1 style="width: 200px; height: 100px; background-color: burlywood; border-radius: 10px; text-align: center;"><a href="<?php permalink_link(  ) ?>"><?php the_title(); ?></a>  <?php echo get_the_category_list( ',' );  ?> by <?php the_author_posts_link()?></h1>
       <div style="width: 100%; height: 100%; background-color: wheat;"> <p><?php the_content()?></p> </div>
      
          
       <br>
      </div>
      
   
    <?php }
     echo paginate_links();
   ?>
   
   <?php get_footer( ) ?>