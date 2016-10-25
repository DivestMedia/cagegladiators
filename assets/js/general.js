function xyrLoadImg() {
    $( ".img_place" )
        .each( function () {
            if ( isScrolledIntoView( this ) == true ) {
                if ( $( this )
                    .attr( 'org_img' ) !== undefined ) {
                    var the_orig_img = $( this )
                        .attr( "org_img" );
                    this.src = the_orig_img;

                    $( this )
                        .animate( {
                            opacity: 0.01
                        }, 1 );
                    $( this )
                        .animate( {
                            opacity: 1
                        }, 800 );

                    $( this )
                        .removeAttr( "org_img" );
                    $( this )
                        .removeClass( "img_place" );

                    console.log( the_orig_img );
                }
            }
        } );
}

jQuery( function ( $ ) {
    $(window).scroll(function(){
        clearTimeout($.data(this, 'scrollTimer'));
        $.data(this, 'scrollTimer', setTimeout(function() {
            var cur_width = $(window).width();
            if(cur_width>=769){
                var list_fighter_nav_top = $('#list-fighter-nav').parent().offset().top;
                var list_fighter_height = parseInt($('#list-fighter-nav').css('height').replace('px',''));
                var window_top = $(window).scrollTop();
                var header_height = $('#header').height();
                var parent_height = $('#list-fighter-nav').parent().parent().height();
                var parent_top = $('#list-fighter-nav').parent().parent().offset().top;
                if(list_fighter_nav_top<window_top){
                    var current = window_top+list_fighter_height+header_height;
                    var max = list_fighter_nav_top+parent_height;
                    if(max<current){
                        var margin_top = parent_height-list_fighter_height-header_height;
                        $('#list-fighter-nav').animate({marginTop:margin_top+'px'});
                    }else{
                        var margin_top = window_top-list_fighter_nav_top+header_height;
                        $('#list-fighter-nav').animate({marginTop:margin_top+'px'});
                    }
                }else{
                    $('#list-fighter-nav').animate({marginTop:'0'});
                }
            }
        }, 100));
    });
     $(window).trigger('scroll');
    $("#list-fighter-nav").on('click','a',function(e) {
        e.preventDefault();
        $(this).parent().addClass('active').siblings().removeClass('active');
        var sec_id = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $(sec_id).offset().top-65
        }, 500);
    });
});