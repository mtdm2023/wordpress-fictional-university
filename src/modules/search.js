import $ from 'jquery';

class Search {
    constructor() {
        $(document).ready(() => {
            this.spinner = $(".spinner");
            this.overlay = $(".overlay");
            this.search_btn = $(".search__btn");
            this.search_field = $("#search_input");
            this.close_btn = $(".close_overlay_btn");
            this.is_loading  = false;
            this.searchres = $(".searchResult");
            this.events();
            this.timout;
        });
    }

    launch_overlay() {
           console.log("hello");
        this.overlay.removeClass('overlay_search');
    }

    events() {
      
        this.search_btn.on("click", () => {
            this.launch_overlay();
        });
        this.close_btn.on('click' , ()=>{
            this.overlay.addClass('overlay_search')
        })
        this.search_field.on("keyup", this.keyPressed.bind(this));
   
    }   

    keyPressed(event) {
        // Access the value of the input text field
        this.spinner.removeClass('spinner');
        clearTimeout(this.timout);
          this.timout=setTimeout(() => {
            this.spinner.addClass('spinner');
            const inputValue = this.search_field.val();
             $.getJSON(baseData.root_url+'/wp-json/university/search?term='+ this.search_field.val() , (allSearchRes)=>{
                
                this.searchres.html(
                  `${this.search_field.val() !=0 ? `<div class ="row" style = "width : 100% ; height : 100%">
                        <div class = "col-lg-4 col-md-4 col-sm-12 col-12">
                          <h1>general information</h1>
                           ${allSearchRes.length !=0 ? `${allSearchRes.jeneral_info.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`)}`: `<p> No result</p>` }
                        </div>
                        <div class = "col-lg-4 col-md-4 col-sm-12 col-12">
                        <h1>professor data</h1>
                        ${allSearchRes.length !=0 ? `${allSearchRes.professorsData.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`)}`: `<p> No result</p>` }
                        </div>
                        <div class = "col-lg-4 col-md-4 col-sm-12 col-12">
                         <h1>event data</h1>
                        ${allSearchRes.length !=0 ? `${allSearchRes.eventData.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`)}`: `<p> No result</p>` }
                        </div>
                        <div class = "col-lg-4 col-md-4 col-sm-12 col-12">
                         <h1>campuse data</h1>
                        ${allSearchRes.length !=0 ? `${allSearchRes.campuseData.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`)}`: `<p> No result</p>` }
                        </div>
                        <div class = "col-lg-4 col-md-4 col-sm-12 col-12">
                         <h1>programs data</h1>
                        ${allSearchRes.length !=0 ? `${allSearchRes.programs.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`)}`: `<p> No result</p>` }
                        <p>Related professors</p>
                        ${allSearchRes.length !=0 ? `${allSearchRes.professorsData.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`)}`: `<p> No result</p>` }
                        </div>
                    </div>` : `<p>write any thing</p>`}`    
                    
                   )
            })
            
           
         
            
        }, 1000);
    }
}

export default Search;