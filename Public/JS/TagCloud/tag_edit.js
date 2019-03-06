$(function() {

    $(".tag_submit").click(function(){

        var is_yixuan = $.cookie('isyixuan');

        if(is_yixuan){

            switch (is_yixuan){

                case 'yes' : 
                    var button_name = $(this).attr('name');
                    var button_type = $(this).attr('type');
                    
        
                    var old_places = $("#"+button_name+"").attr("old")
                    var new_places = $("#"+button_name+"").val()
        
                    var theurl = "{:U('TagCloud/save_tag')}";
                    $.post(
                        theurl,
                        {	
                            'new_places'  : new_places,
                            'old_places'  : old_places,
                            'tag_type'    : button_type,
                        },
                        function(data) {
                            alert(data);
                            location.reload();
        
                        }
                    )
                break;
                default : alert("你不是艺璇, 不能操作"); 

            }


        }else{

            $('#myModal').modal('toggle');  

        }
    })




// ----------------------- original plugin

    $('.tags').tagsInput({
        'onAddTag': function(input, value) {
            console.log('tag added', input, value);
        },
        'onRemoveTag': function(input, value) {
            console.log('tag removed', input, value);
        },
        'onChange': function(input, value) {
            console.log('change triggered', input, value);
        }
    });

    
    
});