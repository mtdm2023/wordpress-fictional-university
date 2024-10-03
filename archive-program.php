<?php get_header()?>

<div style="width:75%; margin: auto; height: 200px; background-color: black" class="d-flex flex-column justify-content-center align-items-center">
 
   <h1><?php if (is_category())
      {
        single_cat_title( );
      }
    ?></h1>
    <p> <?php the_archive_description( ) ?></p> 
    <p><?php if (is_author())
    {
       echo "<p>this post posted by</p>" . the_author( );
    } ?></p>
</div>

  <?php 
    while(have_posts())
    {
      the_post(); ?>
      <div style="width: 75%; margin: auto; margin-top: 20px !important;">
       
       <h1 style="width: 200px; height: 100px; background-color: burlywood; border-radius: 10px; text-align: center;"><a href="<?php permalink_link(  ) ?>"><?php the_title(); ?></a>  <?php echo get_the_category_list( ',' )?> </h1>
       <div style="width: 100%; height: 100%; background-color: wheat;"> <p><?php the_content()?></p> </div>
       
       <br>
      </div>
      
   
    <?php }
   ?>
   
   <?php get_footer( ) ?>
   