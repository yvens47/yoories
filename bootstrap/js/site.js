/**
 * Created by mardocheepierre on 3/22/15.
 */

    $(document).ready(function(){

       // alert("hello");

        $(".sregister").submit(function(e){
            var pass = $('.pass').val();
            if(App.events.inputLen(pass, 8) == 0){
                alert("password is too short");
                
            }
            console.log(pass);
            e.preventDefault();


        })
        console.log("say si")

    })

var App = App || {};

App.events = {
    inputLen : function(input, len){
         alert(input.length);
         if(input.length < len){

             return 0;
         }
        else{
             return 1;
         }
    }

}


