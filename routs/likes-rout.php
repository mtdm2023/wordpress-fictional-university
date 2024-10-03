<?php 

function create_Likes_rout( )
{
    register_rest_route( "university", "Likes", array(
         "methods" => "POST",
         "callback" => "create_likes_post"
    ) );
    register_rest_route( "university", "Likes", array(
         "methods" => "DELETE",
         "callback" => 'Delete_likes_post'
    ) );
}

function create_likes_post($data)
{
    $proffID = sanitize_text_field( $data['proffesor_id'] );

    if(is_user_logged_in( ))
    {
       

         $exist_query = new WP_Query(
            array(
              'author' => get_current_user_id(  ),
              'post_type' => 'like',
              'meta_query' => array(
                array(
                'key' => 'proffessor_id', 
                'compare' => '=',
                'value' => $proffID
     
                )
                  )
            )
              );

              if($exist_query->found_posts == 0 && get_post_type( $proffID ) == 'professor')
              {
                return  wp_insert_post( array(
                    "post_type" => "like",
                    "post_status" => "publish",
                    "post_title" => "hey",
                     "meta_input" => array(
                       "proffessor_id" => $proffID
                     ) 
                 ) );
              }
              else
              {
                die("invalid professor id");
              }
    }
    else
    {
        die("only loged in users can create likes");
    }
  
}
function Delete_likes_post($data)
{
    if(get_current_user_id() == get_post_field( 'post_author', $data['like_post_id'] ) and get_post_type($data['like_post_id']  ) == "like")
    {
        wp_delete_post($data['like_post_id'] , true);
        return 'congrats deleted successfully';
    }
   
}

add_action( "rest_api_init" , "create_Likes_rout" );
?>