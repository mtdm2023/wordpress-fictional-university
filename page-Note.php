<?php get_header( )?>

     <div style="margin-bottom: 50px; display: flex; justify-content: center; width: 100%; font-size: 60px; font-weight: bold;">Create your note here</div>

      <div style="width: 75%; margin: auto; height: auto; display: flex; flex-direction: column; justify-content: space-around; background-color: blanchedalmond; gap: 50px; margin-bottom: 100px; padding: 20px 0; ">
        
        <h1 style="margin-left: 20%;">Title</h1>   
       <input class="cNote_title" type="text" style="width: 60%; margin: auto; height: 50px;">
       <h1 style="margin-left: 20%;">Note</h1> 
       <textarea class="cNote_content" name="content" id=" "style="width: 60%; margin: auto; min-height: 100px  ;"></textarea>
       <div style="margin-left: 20% ; display: flex; gap: 50px; align-items: center ; width: 40% ;"><span  class="Create_btn" ><i  class="fa fa-edit" style="margin-right: 5px;"></i> create</span> <span class="limit_text activee" style="color: red;"> ddddddddd</span></div>
       
       
      </div>
      <div style="margin-bottom: 50px; display: flex; justify-content: center; width: 100%; font-size: 60px; font-weight: bold;">Edite your Notes here</div>

<div  style="width: 75%; height:500px; background-color: whitesmoke; margin: auto; overflow-y: scroll;">
    <div class="available_nots" style="width: 100%; height: 100%; display: flex; align-items: center; flex-direction: column; justify-content: center; ">
      <?php 
        $allnotedofuser = new WP_Query(array(
          "post_type" => 'Note',
          "author" => get_current_user_id()
        ));
        if($allnotedofuser->have_posts())
        {
        while($allnotedofuser->have_posts())
    {
      $allnotedofuser->the_post(); ?>
      
       <div  style="width: 60%; margin: auto; height: auto; display: flex; justify-content: space-between; align-items: center;">
        
        <div  style="display: flex; flex-direction: column; width: 80%; gap: 10px; height: auto; position: relative;" data-id = "<?php the_ID(); ?>">
          <input class="input_title" readonly value="<?php echo str_replace("Private: ", "", get_the_title ())?>">
          <textarea class="input_content" readonly><?php echo  str_replace("Private: ", "", get_the_content())?></textarea>
          <button class="btn btn-primary btn_save hide" style="position: absolute; bottom: -50px; left: 0;"><i class="fa fa-save" style="color: white !important; margin-right: 5px;"></i>Save</button>
        </div>
       
       <div  style="display: flex; gap: 10px ;" data-id = "<?php the_ID(); ?>">
        <span  class="Edit_btn edite_button"><i  class="fa fa-edit" style="margin-right: 5px;"></i> Edite</span>
        <span  class="delete_btn delete_button"><i  class="fa fa-trash" style="margin-right: 5px;"></i> Delete</span></div>
       
       </div>
      
      
     
      
    <?php }}
    else{
      ?>
      <h1>No Nots for  <?php echo get_author_name(  get_current_user_id()) ?> </h1>
      <?php
    }
   ?>
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
   <?php ?>