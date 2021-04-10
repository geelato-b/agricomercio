$(document).ready(function(){

   $('.fa-bars').click(function(){
            $('.navbar').toggle();
            $(this).toggleClass('fa-times');
        });

        $('.navbar, .navbar a').click(function(){
            $('.navbar').hide();
            $('.fa-bars').removeClass('fa-times');
        });


        $('#search, .fa-search').mouseenter(function(){
            $('.nav-bar').hide();
        });
    
        $('#search, .fa-search').mouseleave(function(){
            $('.nav-bar').show();
        });
    
  

});




