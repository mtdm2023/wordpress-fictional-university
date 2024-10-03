<?php get_header( )?>

   <?php 
      $prfessor_likes = new WP_Query(
        array(
          
          'post_type' => 'like',
          'meta_query' => array(
            array(
            'key' => 'proffessor_id', 
            'compare' => '=',
            'value' => get_the_ID(),
 
            )
              )
        )
          );
      $exist_query = new WP_Query(
        array(
          'author' => get_current_user_id(  ),
          'post_type' => 'like',
          'meta_query' => array(
            array(
            'key' => 'proffessor_id', 
            'compare' => '=',
            'value' => get_the_ID(),
 
            )
              )
        )
          );
   
    ?>
  <div style="text-align: center; width: 75%; margin: auto; display: flex; flex-direction: column; justify-content: center; align-items: center; height: 800px; background-color: black;">
  <span class="like_heart" style="width: 100px; height: 30px; background-color: white; border-radius: 5px; display: flex; justify-content: space-between;" data-id ="<?php echo get_the_ID(); ?>" data-like ="<?php if(isset($prfessor_likes->posts[0]->ID))  {echo $prfessor_likes->posts[0]->ID ;} ?>"
   data-exists = "<?php 
   if($prfessor_likes->found_posts && $exist_query->found_posts)
  {echo "yes";}
   else {echo "no";} ?>"  ><i class="fa fa-heart" style="width: 50px; height: 30px; color:white !important;"></i><div class="counter" style="color: black;"><?php echo $prfessor_likes->found_posts; ?></div> </span>
    <h1 style=" width: 500px; "><?php the_title( ) ?></h1>
    
   
    <p><?php the_content( ) ?></p>
    <img style="width: 200px; width: 200px;" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
    
   
   
    <p><?php $arrF = get_field('related_programs');
        foreach($arrF as $prog)
        {
            ?>
            <p>Related programs</p>
            <a href="<?php echo get_the_permalink( $prog ) ?>"><p><?php echo get_the_title( $prog ) ?></p></a>
        <?php
        }
    ?></p>
    <a href="<?php echo site_url( '/event')?>"><div class="_button">back to posts</div></a> 
  </div>

