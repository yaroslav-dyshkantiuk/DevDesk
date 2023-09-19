JQuery(document).ready(function($){
    $('#button_car').on('click', function(e){
        e.preventDefault;
         
        $.ajax({
            url: devdesk_ajax_script.ajaxurl,
            data: {
                'action' : 'devdesk_ajax_example',
                'nonce' : devdesk_ajax_script.nonce,
                'string_one' : devdesk_ajax_script.string_box,
                'string_two' : devdesk_ajax_script.string_new
            },
            success : function(data){
                $('#car_content').html(data);
            },
            error : function(errorThrown){
                console.log(errorThrown);
            }
        });
    });
});