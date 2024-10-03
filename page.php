<?php get_header( )?>

<div class="parent" style="width: 75%; height:500px; background-color: black; margin: auto;">
    <div class="children">
        <?php 
          $has_children_test_arr = get_pages( array (
            "child_of" => get_the_ID()
          ) ) ;
      
        if ($has_children_test_arr) { ?>   
        <ul style="  width: 100%; height: 100%; background-color: burlywood;">
            
                <?php 
                if (wp_get_post_parent_id( get_the_ID() ))
                {
                    $find_child_of_parent = wp_get_post_parent_id( get_the_ID() );
                }
                else{
                    $find_child_of_parent = get_the_ID(); 
                }
                 ?>
            <?php wp_list_pages( array(
            "title_li" => null,
            "child_of" => $find_child_of_parent
        ) ) ?>
         
        
        </ul>
        <?php } ?>
        <div style=" width: 100%;   ">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores inventore molestias accusantium facere doloremque, officiis tempora fugiat dicta quis earum cupiditate iste quae nam suscipit et labore nostrum iusto reprehenderit.</p>
        </div>
    </div>
</div>
<?php 
    while(have_posts())
    {
      the_post(); ?>
  
      <h1><?php the_title (  ) ?></h1>
      <p><?php the_content()?></p>
      
    <?php }
   ?>
   