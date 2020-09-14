$(document).ready(function(){   
    
    // Get random images for login background 
    var images = ["estudiantesbg-1.jpg", "estudiantesbg-2.jpg", "estudiantesbg-3.jpg", "estudiantesbg-4.jpg"];
    var random = Math.floor(Math.random() * images.length);    
    $(".bg-hero").css("background-image", "url('assets/img/" + images[random] + "')");  

});