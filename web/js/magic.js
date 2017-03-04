var PAGE = 1;

$('.load-more-articles').click(function(){
    var btn = $(this);
    PAGE = PAGE++;
    $.ajax({
        type: 'GET',
        url: '/',
        dataType: 'json',
        data: {page: PAGE},
        beforeSend: function(){
            btn.html( btn.text() +  ' <i class="fa fa-spinner fa-spin"></i>');
        },
        complete: function(){
            btn.find('.fa-spin').remove();
        },
        error: function( response ){
            console.log( response );
        },
        success: function( articles ){
            if( articles.length ){
                alert( "got " + articles.length + ' articles!' );
                console.log( articles );
            }
        }
    });
});
