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
       <div style="width: 100%; height: 100%; background-color: wheat;"> 
        <h1>Related Programms</h1>
          
         </div>
      
       <br>
      </div>
      
   
    <?php 
   
    $related_programs = new WP_Query(
        array(

          "posts_per_page" => 2,
          "post_type" => "program",
          "meta_query" => array(
          array(
            'key' => 'campuses',
            'compare' => 'like',
            'value' => '"'. get_the_ID() .'"',
       
          )
)
        )
    );
   
    while ($related_programs ->have_posts())
    { 
      $related_programs->the_post(); ?>
      <div style="width: 75%; margin: auto;  height: auto;  background-color: black ;">
           
      <h1 style="color: white;"><a style="color: orange;" href="<?php echo get_the_permalink(  ) ?>"><?php echo get_the_title( ) ?></a></h1>
      <p style="color: white;"><?php echo get_the_content()?> </p>
             <?php ?>
        </div>
    
      
    <?php }
  
  wp_reset_postdata(  );    
  }
   ?>
    