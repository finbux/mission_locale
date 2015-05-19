$(function(){
        $('.item').click(function(){
            var value = $(this).prev(".id_sous_item").val();
            var data = {
                id_item: value
            };

            $.ajax({
                //url: "http://localhost/symfony_ml/web/app_dev.php/description/"+ value,
                url: Routing.generate('sous_item_page', { id : value}),
                type: 'get',
                data: data,
                beforeSend: function(){
                   // console.log(value)
                },
                success: function(data){
                    $(".item_right").show();
                    $(".item_right .description").html(data.description);
                }
            });
        });
});
