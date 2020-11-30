//Fade out error
$(function(){
    $(".close_error").click(function () {
        $(this).parent('.bad').fadeOut()
    })
})

$("#new_user_tooltip").on({
    "click": function() {
        $(this).tooltip({ items: "#tt", content: "Requires a valid email. Passwords must be at least 3 characters in length."});
        $(this).tooltip("open");
    },
    "mouseout": function() {      
        $(this).tooltip("disable");   
    }
});