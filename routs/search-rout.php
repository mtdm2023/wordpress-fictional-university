<?php 

function new_search_rout()
{
    register_rest_route( "university", "search", array(
        "methods" => "Get",
        "callback" =>'get_searchData'
    ) );
}

function get_searchData($data)
{
    
    $all_res = new WP_Query(array(
        "post_type" => array('post' , 'page' , 'professor', 'event', 'campuse' , 'program'),
         's' => $data['term']

    ));

    

    $filteredALLdata = array(
        'jeneral_info' =>array(),
        'professorsData' => array(),
        'eventData' => array(),
        'programs' =>array(),
        'campuseData' =>array()
    );
    
   
    while($all_res->have_posts())
    {
        $all_res->the_post();
       if(get_post_type( ) == 'post' or get_post_type( ) == 'page' )
       {
         array_push($filteredALLdata['jeneral_info'] ,array(
            'title' => get_the_title(),
             'permalink' => get_permalink()
        ) );
       }
       if(get_post_type( ) == 'event' )
       {
        array_push($filteredALLdata['eventData'] ,array(
            'title' => get_the_title(),
             'permalink' => get_permalink()
        ) );
       }
       if(get_post_type( ) == 'professor' )
       {
        array_push($filteredALLdata['professorsData'] ,array(
            
            'title' => get_the_title(),
             'permalink' => get_permalink()
             
        ) );
       }
    
       if(get_post_type( ) == 'program' )

       {
        $related_campuses = get_field('campuses');
        if($related_campuses)
        {
            foreach($related_campuses as $camps)
            {
                array_push($filteredALLdata['campuseData'] ,array(
                    'title' => get_the_title($camps),
                     'permalink' => get_permalink($camps)
                ) );
            }
        }
        array_push($filteredALLdata['programs'] ,array(
            'id' => get_the_ID(  ),
            'title' => get_the_title(),
             'permalink' => get_permalink()
        ) );
       }
    }
   
    $allRelartedProfessors = new WP_Query(array(
        'post_type' => 'professor',
        'meta_query' => array(array(
         'key' => 'related_programs',
         'compare' => 'LIKE',
         'value' => '"'. $filteredALLdata['programs'][0]['id'] .'"'  
        ))
 
     )   
     );
     while ($allRelartedProfessors-> have_posts(  ))
     {
         $allRelartedProfessors->the_post(  );
          
         if(get_post_type( ) == 'professor' )
         {
          array_push($filteredALLdata['professorsData'] ,array(
              'title' => get_the_title(),
               'permalink' => get_permalink()
          ) );
         }
 
     }
    return$filteredALLdata;
}
add_action( "rest_api_init", "new_search_rout" );

?>
