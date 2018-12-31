jQuery(document).ready(function ($) {
    $('ul.cards').on('click', function () {
        $(this).toggleClass('transition');
        // $(this).toggleClass("card_my_content");
        card_extend($(this));
    });
    $('ul.card-stacks').on('click', function () {
        $(this).toggleClass('transition');
        card_extend($(this));
    });
    $('ul.cards-split').on('click', function () {
        $(this).toggleClass('transition');
    });
    $('ul.cards-split-delay').on('click', function () {
        $(this).toggleClass('transition');
    });

    function card_extend(the_obj){

        if(the_obj.hasClass('transition')){
            the_obj.find('.card').addClass("card_my_content");
            // setTimeout(function(){
                the_obj.css("height","1200px");
            // },1000)
            
            
        }else{
            the_obj.find('.card').removeClass("card_my_content");
            setTimeout(function(){
                the_obj.css("height","400px");
            },500)
           
        }


    }




});
