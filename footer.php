<?php wp_head() ?>

  


<footer>
        <div class="footer" style="width: 100%; height: 600px; background-color: burlywood;">
                <ul>
               
                  <?php
                    
                  // Get the menu object by location
                  $menu_name = 'footerMenue'; // This is the menu location
                  $locations = get_nav_menu_locations();
                  
                  if (isset($locations[$menu_name])) {
                      $menu_id = $locations[$menu_name];
                      $menu_items = wp_get_nav_menu_items($menu_id); ?>
                      
                      <div style="width: 75%; margin: auto; height: 100%;  display: flex;">
                        <div class="menu1" style="flex-grow: 1;" >
                            <ul  style="display: flex; flex-direction: column; gap: 5px; justify-content: center; align-items: center;;">
                              <li><h1>Blog</h1></li>
                              <li><a href="<?php echo esc_url($menu_items[1]->url); ?>"><?php echo $menu_items[1]->title; ?></a></li> 

                            </ul>
                            
                             
                        </div>
                        <div class="menu2"  style="flex-grow: 1;" >
                            <ul  style="display: flex; flex-direction: column; gap: 5px; justify-content: center; align-items: center;">
                              <li><h1>Home</h1></li>
                              <li><a href="<?php echo esc_url($menu_items[0]->url); ?>"><?php echo $menu_items[0]->title; ?></a></li> 

                            </ul>
                            
                             
                        </div>
                        <div class="menu3"  style="flex-grow: 1;" >
                            <ul  style="display: flex; flex-direction: column; gap: 5px; justify-content: center; align-items: center;">
                              <li><h1>about us</h1></li>
                              <li><a href="<?php echo esc_url($menu_items[2]->url); ?>"><?php echo $menu_items[2]->title; ?></a></li> 

                            </ul>
                            
                             
                        </div>
                      </div>
                  <?php } else {
                      echo 'Menu not assigned to this location.';
                  }
                  ?>
            
           
           
                </ul>
          
        </div>
</footer>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>