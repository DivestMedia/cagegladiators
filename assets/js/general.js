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
    $("#list-fighter-nav").on('click','a',function(e) {
        e.preventDefault();
        $(this).parent().addClass('active').siblings().removeClass('active');
        var sec_id = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $(sec_id).offset().top-65
        }, 500);
    });

});