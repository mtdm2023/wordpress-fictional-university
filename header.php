<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
     <?php wp_head() ?>
</head>
 
<body>
<div class="overlay overlay_search" style="position:fixed !important;  width: 100vw; height:100vh; background-color: black; opacity: 70%; transition: 1s ease-in-out; padding-top: 50px; ">
    <div style="width: 100%; display: flex; justify-content: space-around; margin-bottom: 50px;">
        <input  type="text" name="" id="search_input" style="background-color: transparent; border: none !important; border-color: transparent !important;width: 20%;height: 50px; font-size: 50px;" placeholder="Search what you want">  
        <div class="close_overlay_btn"><i class=" fa fa-window-close" style="font-size: xx-large;"></i></div>
         
    </div>
 
    <div style="width: 60%; display: flex; justify-content: center;">
      <div class=" spinner lds-dual-ring" ></div>  
    </div>
  
    <div class="searchResult" style="background-color: white; width: 60%; height: 60%; margin: auto; opacity: 1 !important;">

    </div>
</div>
    
<header>
     <nav>
      <ul>
       
      <?php

         wp_nav_menu( array(
            'theme_location' => 'header-menu',
             'container_class' => 'custom-header-menu-class' 
         ) )
        ?><li >
            <div style="width: 100px; height: 50px; background-color: orange; display: flex; justify-content: space-between ; align-items: center; border-radius: 8px;">
                <?php
                if(is_user_logged_in(  ))
                {?>
                    <a href="<?php echo wp_logout_url(  ) ?>"><span style="text-wrap: nowrap; font-weight: bold; color: white; display: inline-block    ;">log-out</span></a>
                    <span><?php 
                    if(get_avatar( get_current_user_id(  ) ))
                    {
                        echo get_avatar( get_current_user_id(  ), 50);
                    } ?></span>
                 <?php
                 }
                else
                {?>
                 <a href="<?php echo wp_login_url( ) ?>"><span>login</span></a>
                 <span><?php echo get_avatar( get_current_user_id(  ), 50) ?></span>  
                <?php
                }
                 ?>
              
            </div>
            
        </li>   
        
      </ul> 
     

    </nav>
    
 </header>      