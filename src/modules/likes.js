import $ from "jquery";
class likes {

    constructor()
    {
        $(document).ready(() => {
       this.like_heart = $(".like_heart");
       this.events ();
        });
    }






    events ()
{
    this.like_heart.on("click" , (e)=> this.Like_Dispasher(e)
       
    );


      
}




Like_Dispasher (e)
{
  var liked = $(e.target).closest(".like_heart");
  if (liked.attr("data-exists") == "no") {
    console.log("create Like");
    this.createLike(e);
    liked.attr("data-exists", "yes"); 
  
    // Corrected line
  } else {
    console.log("delete Like");
    this.Delete_like(e);
    liked.attr("data-exists", "no");
    
    // Corrected line
  }
}
//methods

createLike(e)
{
    console.log("liked");
    var ProffessorObject = {
      "proffesor_id" : $(".like_heart").data('id')
     
    };
     
   
   
   $.ajax({
    beforeSend : (xhr)=>{
      xhr.setRequestHeader('X-WP-Nonce' , baseData.nonce);    
    },
    url : baseData.root_url+'/wp-json/university/Likes',
    data : ProffessorObject,
    type: 'POST',  
   
 
  success : (response)=>
  { //alert("Liked_successfully");
    console.log("liked_succ")
    var el =  $(".like_heart").find('.counter');
    $(".like_heart").attr("data-like" , response)
    var counter = parseInt(el.html(), 10);
    counter++;
    el.html(counter);
   
    
    

  },
  error : (response)=>{
  
  }

});
}

Delete_like(e)
{
    
    var notObject = {
      "proffesor_id" : $(".like_heart").data('id'),
      "like_post_id" : $(".like_heart").data('like'),
     
    };
    
   
   
   $.ajax({
    beforeSend : (xhr)=>{
      xhr.setRequestHeader('X-WP-Nonce' , baseData.nonce);    
    },
    url : baseData.root_url+'/wp-json/university/Likes',
    data : notObject,
    type: 'DELETE',  
   
 
  success : (response)=>
  { 
    //console.log("deleted ssss");
    //alert("Deleted Successfuly");
    var el =  $('.like_heart').find(".counter");
    var counter = parseInt(el.html(), 10);
    counter--;
    el.html(counter);
  },
  error : (response)=>{

  }

});
}
}




export default likes;