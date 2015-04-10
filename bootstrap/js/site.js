/**
 * Created by mardocheepierre on 3/22/15.
 */

$(document).ready(function () {

    // alert("hello");


    $(".sregister").submit(function (e) {
        var pass = $('.pass').val();
        if (App.events.inputLen(pass, 8) == 0) {
            alert("password is too short");

        }
        console.log(pass);
        e.preventDefault();


    })
    console.log("say si")
    //App.events.scrollDown();


    $(".addons li h2 i:first").click(function () {
        alert("hi");
    })
        $(".share-add").click(function(e){

            $(".sharer").load("http://yoories.com/Post/add.php",function(e){

                console.log(e);
            });

            e.preventDefault();
        })

    $("textarea").focus(function(){
        $(this).css("height","300");
    })

})

var App = App || {};

App.events = {
    inputLen: function (input, len) {
        alert(input.length);
        if (input.length < len) {

            return 0;
        }
        else {
            return 1;
        }
    }


}
