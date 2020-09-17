$(document).ready(function(){   
    
    // Get random images for login background 
    var images = ["logo.png", "logo.png", "logo.png", "logo.png"];
    var random = Math.floor(Math.random() * images.length);    
    $(".bg-hero").css("background-image", "url('assets/img/" + images[random] + "')");  

});