function deleteProduct(productID){
    $('#order-'+productID).remove();
}

$(document).ready(function() {
    
    $('.products > a').on('click',function(e){

        let name = $('#'+$(this).data('target')).text();
        let pid = $(this).data('target');

        if($('#orders #order-'+pid).length === 1){
            console.log("this already exists")
        }else{
            $output = '<div class="card-body border-bot order" id="order-'+pid+'">'+name;
            $output+= '<a data-target="'+pid+'" onclick="deleteProduct('+pid+')"><i class="fas fa-times-circle fa-2x pull-right"></i></a>';
            $output+= '<input type="text" style="width: 40px;" class="pull-right" value="1"/>';
            $output+= '</div>'

            $("#orders").append($output);
        }
    });
});







