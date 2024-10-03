
<?php 
require get_theme_file_path( "/routs/search-rout.php" );
require get_theme_file_path( "/routs/likes-rout.php" );
function page_panner($args)
{
  
}
function add_field_rest_api()
{
  register_rest_field( 'post', 'author_name', array(
    'get_callback' => function()
    {
      return get_the_author();
    }
  ) );
}

add_action( "rest_api_init"  ,"add_field_rest_api" );
function add_scriptsAndStyles()
{
  wp_enqueue_script('jquery');
  wp_enqueue_style( "main_style" , get_stylesheet_uri(  ) );
  // wp_enqueue_script('main-university-js', get_theme_file_uri('js/inde.js'), array('jquery'), '1.0', true);
  wp_enqueue_script('my-custom-script', get_theme_file_uri( '/build/index.js' ));
  // wp_enqueue_script('custom-script', get_theme_file_uri( '/js/main.js' ) );
  wp_enqueue_style( "fontaowsome" , "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css");
  wp_enqueue_style( "bootstap" , "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css");
  wp_enqueue_script( "fontjs" , "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"); 
  wp_enqueue_script( "bootstrapjs" , "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"); 
  wp_localize_script( "my-custom-script", 'baseData', array(
      'root_url' => get_site_url( ),
      'nonce' => wp_create_nonce('wp_rest')
  ) );
  
}

function redirect_subscribers()
{
  if(count(wp_get_current_user()->roles) == 1 and wp_get_current_user()->roles[0] =='subscriber'  )
  {
     wp_redirect(site_url( '/' ));  
     exit;
  }
}
add_action("wp_enqueue_scripts" , "add_scriptsAndStyles");
add_action("admin_init" , "redirect_subscribers");


function filter_postdata($data , $postData)
{
  if($data['post_type'] == 'note')
  {
    $data['post_content'] = wp_strip_all_tags( $data['post_content'] );

    
    $data['post_title'] =  str_replace("Private: ", "", wp_strip_all_tags( $data['post_title'] ));
    
  }
  if(( $data['post_type'] == 'note' and count_user_posts( get_current_user_id(  ) , "note" ) > 5) and !$postData ['ID'])
  {
    die("you reached your post limit");
  }
  return $data;
}


function modify_post_data($posts)
{
  if($posts->post_type == 'note' )
  {
    $posts->post_title = str_replace("Private: ", "", wp_strip_all_tags( $posts->post_title ));
    

  }
}
add_filter( "wp_insert_post_data", "filter_postdata" ,10 ,2 );

add_action( 'the_post', 'modify_post_data' );










function features()
{
  add_theme_support( "title_tage" );

 
  add_theme_support( "post-thumbnails" ); // here this support is added to blogs only and not added to custom post types to add this support to custome post type you can add it in mu-plugins file 
  register_nav_menu( "headermenu", "header menu" );
  register_nav_menu( "footerMenue", "footer Menue" ); 
    
}

function universCustomQuery ($query){
  if(!is_admin(  ) and is_post_type_archive( 'event' ))
  {
    $query->set('posts_per_page' , 4);
    $query->set('meta_key' , "event_date");
    $query->set('meta_query' , array(
      array(
        'key' => 'event_date',
        'compare' => '>=',
        'value' => date('Ymd'),
        'type' => 'numeric'
      )
    ));
  }
}

function yourtheme_add_woocommerce_support() {
  add_theme_support( 'woocommerce' );
}

add_action( "after_setup_theme" , "features" );
add_action( "after_setup_theme" , "yourtheme_add_woocommerce_support" );

add_action( "pre_get_posts" , "universCustomQuery" );



function my_custom_menus() {
  register_nav_menus(
      array(
          'header-menu' => __( 'Header Menu' ),
      )
  );
}
add_action( 'init', 'my_custom_menus' );


?>

