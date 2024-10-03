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
        <div style="width: 100px; height: 100px; border-radius: 50%; display: flex; flex-direction: column; justify-content: space-around; align-items: center; background-color: yellow;">
            <?php 
            $date_object = new DateTime(get_field('event_date'));
             ?>
               <h1 style="color: black;"><?php echo $date_object->format('M') ?></h1>
               <p style="color: black; font-weight: bold;" ><?php echo $date_object->format('d') ?></p>
             <?php ?>
        </div>
       <h1 style="width: 200px; height: 100px; background-color: burlywood; border-radius: 10px; text-align: center;"><a href="<?php permalink_link(  ) ?>"><?php the_title(); ?></a>  <?php echo get_the_category_list( ',' )?> </h1>
       <div style="width: 100%; height: 100%; background-color: wheat;"> <p><?php the_content()?></p> </div>
       <div style="width: 100%; height: 100%; background-color: wheat;"> 
        <h1>Related Programms</h1>
        <?php  
        $related_programs = get_field('related_programs');
        if($related_programs){
          foreach($related_programs as $program)  
          {
            ?>
            <h2><a href="<?php echo get_the_permalink( $program ) ?>"><?php echo get_the_title( $program ) ?></a></h2>
          <?php
          }     
        }
        else{
          echo "their are no related programms";
        }
          
         ?> </div>
      
       <br>
      </div>
      
   
    <?php }
   ?>
   
   <?php get_footer( ) ?>
   