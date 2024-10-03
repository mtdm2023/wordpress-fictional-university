<?php get_header( )?>

<?php
 ?>
  <div style="text-align: center; width: 75%; margin: auto; display: flex; flex-direction: column; justify-content: center; align-items: center; height: 800px; background-color: black;">
    <h1 style=" "><?php the_title( ) ?></h1>
    <p ><?php the_content( ) ?></p>
    <a href="<?php echo get_post_type_archive_link( 'campuse')?>"><div class="_button">back to all campuses</div></a> 
  </div>
 <?php
  ?>