<?php get_header(); wp_head(  ); ?>
 
<?php 
$today = date('Ymd');
$custom_Posts = new WP_Query(array(
  "posts_per_page" => 5,
  "post_type" => "event",
  "meta_key" => "event_date",
  "orderby" => "meta_value_num",
  "order" => "ASC ",
  "meta_query" => array(
    array(
      'key' => 'event_date',
      'compare' => '>=',
      'value' => $today,
      'type' => 'numeric'
    )
  )

));

 while ($custom_Posts ->have_posts())
    { 
      $custom_Posts->the_post(); ?>
      <div style="width: 100px; height: 100px; border-radius: 50%; display: flex; flex-direction: column; justify-content: space-around; align-items: center; background-color: yellow;">
            <?php 
            $date_object = new DateTime(get_field('event_date'));
             ?>
               <h1 style="color: black;"><?php echo $date_object->format('M') ?></h1>
               <p style="color: black; font-weight: bold;" ><?php echo $date_object->format('d') ?></p>
             <?php ?>
        </div>
      <h1><a href="<?php echo get_the_permalink(  ) ?>"><?php echo get_the_title( ) ?></a></h1>
      <p><?php echo get_the_content()?> </p>
      
    <?php }
     
      wp_reset_postdata(  ); ?>
   <?php $custom_query = new WP_Query(array(
      "posts_per_page"=>2,
      "category_name" => "Gold"
   
   ));
while ($custom_query->have_posts(  ))
     {
      $custom_query->the_post(  ); ?>
      <h1><a href="<?php echo get_the_permalink(  ) ?>"><?php echo get_the_title( ) ?></a></h1>
      <p><?php echo get_the_content()?> </p>
     
     <?php }
?>

<?php wp_reset_postdata(  ) ?>

 

 
   
    

 <?php get_footer(  )?>