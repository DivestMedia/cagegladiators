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

    var resizeId;
    var isloading = 0;
    $(window).resize(function() {
        clearTimeout(resizeId);
        resizeId = setTimeout(doneResizing, 500);
    });

    if($('#section-organizations-fighters').length){
        var page = 2;
        var limit = 12;
        var old_page = 1;
        var cat = $('#section-organizations-fighters').data('cat');
        var base_path = '/organizations/'+cat+'/fighters/';
        window.history.pushState("", "", base_path);
        
        $(window).scroll(function(){
            var window_top = $(window).scrollTop();
            var window_bottom = window_top + $(window).height();
            var f_container_top = $('#section-organizations-fighters').offset().top;
            var f_container_bottom = f_container_top + parseInt($('#section-organizations-fighters').css('height').replace('px',''));
            get_current_page(window_top,window_bottom);
            if(window_bottom>=f_container_bottom&&isloading==0){
                $('.progress-bar-container').show();
                isloading = 1;
                $.ajax({
                    url: window.location.origin+'/wp-admin/admin-ajax.php',
                    dataType: 'json',
                    type: 'POST',
                    data: {
                        'action':'get_fighters',
                        'page':page,
                        'limit':limit,
                        'cat':cat
                    },
                    success: function(result){
                        current_path = base_path+page+'/';
                        if(result.length){
                            $('.fighter_container').append('<div class="row inline-page page-'+page+'" data-page="'+page+'"></div>');
                            var new_container = $('.fighter_container').find('.page-'+page);
                            $.each(result,function(i,f){
                                 new_container.append('<div class="col-sm-6 col-md-4 container-fighters"><a href="'+f.link+'"><div class="thumbnail nopadding-bottom margin-bottom-0 noradius"><img class="img-responsive noradius" src="'+f.thumbnail+'" alt="'+f.title+'" /></div></a><div class="fighter-details"><a href="'+f.link+'"><h4 class="margin-bottom-0">'+f.title+'</h4></a><a href="#"><small class="block lbl-weightclass">'+f.weight+'</small></a><small>'+f.record+'</small></div></div>');
                            });
                             window.history.pushState("", "", current_path);
                            page += 1;
                            if(result.length==limit)
                                isloading=0;
                            $('.progress-bar-container').hide();
                        }else{
                            $('.progress-bar-container').hide();
                        }
                      
                    },
                    error: function(errorThrown){console.log(errorThrown);}
                });
            }
        });

        function get_current_page(window_top,window_bottom){
            $('.fighter_container').find('.inline-page').each(function(){
                var current_top = $(this).offset().top;
                var current_center = current_top+$(window).height()/2;
                if(window_top<=current_center&&window_bottom>=current_center){
                    var new_page = $(this).data('page');
                    if(old_page!=new_page){
                        window.history.pushState("", "", base_path+new_page+'/');
                        old_page=new_page;
                    }
                }
            });   
        }
    }


     
    function doneResizing(){
        var cur_height = $('#slider-vid-1').parent().siblings().find('img').height();
        $('#slider-vid-1').css('height',cur_height+'px')
    }

    window.dispatchEvent(new Event('resize'));

    var cur_page = 2;
    if($('.table-event.paginated').length){
        $('.table-event.paginated').each(function() {
            var currentPage = 0;
            var numPerPage = 10;
            var $table = $(this);
            $table.bind('repaginate', function() {
                $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
            });
            $table.trigger('repaginate');
            var numRows = $table.find('tbody tr').length;
            var numPages = Math.ceil(numRows / numPerPage);
            var $pager = $('<ul class="pagination"></ul>');
            if(numPages>1){
                for (var page = 0; page < numPages; page++) {
                    $('<li class="page-number"></li>').html('<a>'+(page + 1)+'</a>').bind('click', {
                        newPage: page
                    }, function(event) {
                        currentPage = event.data['newPage'];
                        $table.trigger('repaginate');
                        $(this).addClass('active').siblings().removeClass('active');
                    }).appendTo($pager).addClass('clickable');
                }
                $pager.insertAfter($table).find('li.page-number:first').addClass('active');
            }
        });
    }


    if($('.section-organizations-child').length){
        cur_page = 1;
        $('.btn-showmorenews').hide().siblings('.progress').show();
        var cat = $('#section-organizations-news').data('cat');
        $.ajax({
            url: "/news/",
            dataType: 'json',
            type: 'POST',
            data: {
                'action':'getnews',
                'page':cur_page,
                'cat':cat
            },
            success: function(result){
                console.log(result);
                if(result.length<=6&&result.length>0){
                    cur_page++;
                    $.each(result,function(i,n){
                        if(i<3){
                            var post_url = window.location.origin+'/news/'+n['post-id']+'/'+n['post-name'];
                            $('#news-row').append('<div class="col-sm-4"><a href="'+post_url+'"><figure style="border-bottom: 5px solid #e60f0f;background-image: url('+n['post-thumbnail']+');background-size: cover;background-repeat: no-repeat;height: 150px;"></figure></a><h4 class="margin-top-20 size-14 weight-700 uppercase height-50" style="overflow:hidden;"><a href="'+post_url+'">'+n['post-title']+'</a></h4><p class="text-justify height-100" style="overflow:hidden;">'+n['post-content']+'</p><ul class="text-left size-12 list-inline list-separator"><li>'+n['published-date']+'</li></ul></div>');
                        }
                    });

                    $('.btn-showmorenews').show().siblings('.progress').hide();
                }else{
                    $('.btn-showmorenews').hide().siblings('.progress').hide();
                }
            },
            error: function(errorThrown){console.log(errorThrown);}
        });
    }
    if($('#section-organizations-news').length){
        cur_page = 1;
        $('.btn-showmorenews').hide().siblings('.progress').show();
        var cat = $('#section-organizations-news').data('cat');
        $.ajax({
            url: "/news/",
            dataType: 'json',
            type: 'POST',
            data: {
                'action':'getnews',
                'page':cur_page,
                'cat':cat
            },
            success: function(result){
                console.log(result);
                if(result.length<=6&&result.length>0){
                    cur_page++;
                    $.each(result,function(i,n){
                        var post_url = window.location.origin+'/news/'+n['post-id']+'/'+n['post-name'];
                        $('#news-row').append('<div class="col-sm-4"><a href="'+post_url+'"><figure style="border-bottom: 5px solid #e60f0f;background-image: url('+n['post-thumbnail']+');background-size: cover;background-repeat: no-repeat;height: 150px;"></figure></a><h4 class="margin-top-20 size-14 weight-700 uppercase height-50" style="overflow:hidden;"><a href="'+post_url+'">'+n['post-title']+'</a></h4><p class="text-justify height-100" style="overflow:hidden;">'+n['post-content']+'</p><ul class="text-left size-12 list-inline list-separator"><li>'+n['published-date']+'</li></ul></div>');
                    });

                    $('.btn-showmorenews').show().siblings('.progress').hide();
                }else{
                    $('.btn-showmorenews').hide().siblings('.progress').hide();
                }
            },
            error: function(errorThrown){console.log(errorThrown);}
        });
    }

    $('.btn-showmorenews').click(function(){
        $(this).hide().siblings('.progress').show();
        var cat = $('.list-group').find('.active').data('cat');
        if(typeof cat == 'undefined')
            cat = $('#section-organizations-news').data('cat');
        $.ajax({
            url: "/news/",
            dataType: 'json',
            type: 'POST',
            data: {
                'action':'getnews',
                'page':cur_page,
                'cat':cat
            },
            success: function(result){
                console.log(result);
                if(result.length<=6&&result.length>0){
                    cur_page++;
                    $.each(result,function(i,n){
                        var post_url = window.location.origin+'/news/'+n['post-id']+'/'+n['post-name'];
                        $('#news-row').append('<div class="col-sm-4"><a href="'+post_url+'"><figure style="border-bottom: 5px solid #e60f0f;background-image: url('+n['post-thumbnail']+');background-size: cover;background-repeat: no-repeat;height: 150px;"></figure></a><h4 class="margin-top-20 size-14 weight-700 uppercase height-50" style="overflow:hidden;"><a href="'+post_url+'">'+n['post-title']+'</a></h4><p class="text-justify height-100" style="overflow:hidden;">'+n['post-content']+'</p><ul class="text-left size-12 list-inline list-separator"><li>'+n['published-date']+'</li></ul></div>');
                    });

                    $('.btn-showmorenews').show().siblings('.progress').hide();
                }else{
                    $('.btn-showmorenews').hide().siblings('.progress').hide();
                }
            },
            error: function(errorThrown){console.log(errorThrown);}
        });
    });

    if($('#all-news-container').length){
        $(window).scroll(function(){
            var window_top = $(window).scrollTop();
        });
    }

    if($('#list-fighter-nav').length){
        $(window).scroll(function(){
            clearTimeout($.data(this, 'scrollTimer'));
            $.data(this, 'scrollTimer', setTimeout(function() {
                var cur_width = $(window).width();
                if(cur_width>=992){
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
                            var margin_top = parent_height-list_fighter_height-header_height+40;
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
    }
    $("#list-fighter-nav").on('click','a',function(e) {
        e.preventDefault();
        $(this).parent().addClass('active').siblings().removeClass('active');
        var sec_id = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $(sec_id).offset().top-65
        }, 500);
    });
});