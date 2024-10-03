import $ from 'jquery';

class note {
    constructor ()
    {
        $(document).ready(() => {
            this.delete_btn = $(".delete_btn");
            this.Edit_btn = $(".Edit_btn");
            this.btn_save = $(".btn_save");
            this.input_title = $(".input_title");
            this.input_content = $(".input_content");
            this.Create_btn = $(".Create_btn");
            this.cNote_title = $(".cNote_title");
            this.cNote_content = $(".cNote_content");
            this.available_nots = $(".available_nots");
            this.eventss();  
        });
      
    
    }
    

     eventss () {
     this.Create_btn.on('click' , (e) => {this.createNote(e)})
      this.Edit_btn.on('click' , (e) =>this.edit_note(e));
      this.delete_btn.on("click", (e)=>{
         var noteID = $(e.target).parent(); 
        $.ajax({
            beforeSend : (xhr)=>{
              xhr.setRequestHeader('X-WP-Nonce' , baseData.nonce);    
            },
            url : baseData.root_url+'/wp-json/wp/v2/note/' + noteID.data('id') ,
            type : 'DELETE',  
         
          success : ()=>
          { alert("deleted successfuly");
            $(e.target).parent().parent().remove();
          },
          error : (response)=>{
            alert("their is an error" + response);
          }
        
      })
        
      });

      this.btn_save.on('click' , (e) => this.save_note(e));
      }

      edit_note(e)
      {
        $(e.target).parent().parent().find(".input_title , .input_content").removeAttr('readonly');
        $(e.target).html(`
          <i  class="fa fa-times" style="margin-right: 5px;"></i> cancel
          `)
         $(e.target).parent().parent().find(".btn_save").removeClass("hide");
      }


      save_note(e){
        var noteID = $(e.target).parent(); 
        var notObject = {
          "title" : this.input_title.val(),
          "content" : this.input_content.val()
        }
       console.log(notObject);
       
       $.ajax({
        beforeSend : (xhr)=>{
          xhr.setRequestHeader('X-WP-Nonce' , baseData.nonce);    
        },
        url : baseData.root_url+'/wp-json/wp/v2/note/'  + noteID.data('id'),
        type: 'PUT',  
        data : notObject,
     
      success : ()=>
      { alert("Updated successfuly");
        this.btn_save.addClass('hide');
        $(e.target).parent().parent().find('.Edit_btn').html(`
           <i  class="fa fa-edit" style="margin-right: 5px;"></i> Edit
          `)
      },
      error : (response)=>{
      
      }
    
  })

      }

      createNote(e)
      {
        var createNoteObjectData = {
          'title' : this.cNote_title.val(),
          'content' : this.cNote_content.val(),
          'status' : 'private'
        }

        $.ajax({
          beforeSend : (xhr)=>{
            xhr.setRequestHeader('X-WP-Nonce' , baseData.nonce);    
          },
          url : baseData.root_url+'/wp-json/wp/v2/note/' ,
          type: 'POST',  
          data : createNoteObjectData,
       
        success : (resp)=>
        {
          console.log(resp);
          this.available_nots.prepend(`
              <div  style="width: 60%; margin: auto; height: auto; display: flex; justify-content: space-between; align-items: center; margin-bottom : 30px !important;">
        
             <div  style="display: flex; flex-direction: column; width: 80%; gap: 10px; height: auto; position: relative;" data-id = "${resp.id}">
             <input class="input_title" readonly value="${resp.title.raw}">
             <textarea class="input_content" readonly>${resp.content.raw}</textarea>
             <button class="btn btn-primary btn_save hide" style="position: absolute; bottom: -50px; left: 0;"><i class="fa fa-save" style="color: white !important; margin-right: 5px;"></i>Save</button>
             </div>
       
            <div  style="display: flex; gap: 10px ;" data-id = "${resp.id}">
            <span  class="Edit_btn edite_button"><i  class="fa fa-edit" style="margin-right: 5px;"></i> Edite</span>
            <span  class="delete_btn delete_button"><i  class="fa fa-trash" style="margin-right: 5px;"></i> Delete</span></div>
       
            </div>
            `).hide().slideDown();
            console.log(resp);
            if(resp.responseText != '\r\n\r\n\r\nyou reached your post limit')
              $('.limit_text').addClass('activee')
          
        },
        error : (response)=>{
         
          if(response.responseText == '\r\n\r\n\r\nyou reached your post limit')
          $('.limit_text').html(``);   
          $('.limit_text').prepend(`you reached your post limit`).removeClass('activee')
        }
        })
      }
      
    
}

export default note;