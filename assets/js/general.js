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


/** Infininte Scroll
**************************************************************** **/
function _infiniteScroll() {
    var _container  = jQuery(".infinite-scroll-custom"); // Set custom container class

    if(_container.length > 0) {

        loadScript(plugin_path + 'infinite-scroll/jquery.infinitescroll.min.js', function() {

                _navSelector    = _container.attr('data-nextSelector') || "#inf-load-nex",
                _itemSelector   = _container.attr('data-itemSelector') || ".item",
                _nextSelector   = _navSelector + " a";

            _container.infinitescroll({
                loading: {
                    finishedMsg : '<div class="progress-bar progress-bar-success active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 95%"><div><strong>All fighters loaded</strong></div><span class="sr-only">80% Complete</span></div>',
                    msgText     : '<div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 95%"><div><strong>Loading more fighters...</strong></div><span class="sr-only">80% Complete</span></div>',
                    img         : "data:image/gif;base64,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",
                    speed       : 'normal'
                },
                nextSelector    : _nextSelector,
                navSelector     : _navSelector,
                itemSelector    : _itemSelector,
                behavior        : '',
                state: {
                    isDone      : false
                }
            },

            function(newElements) {

                console.log(newElements);

                Init(true);

                if(jQuery().isotope) {

                    _container.isotope('appended', jQuery(newElements));

                    setTimeout( function(){
                        _container.isotope('layout');
                    }, 2000);

                }
            });
        });
    }
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
        var cur_title = $(document).find("title").text();
        // window.history.pushState("", "Hey", base_path);

        $(window).scroll(function(){
            var window_top = $(window).scrollTop();
            var window_bottom = window_top + $(window).height();
            var f_container_top = $('#section-organizations-fighters').offset().top;
            var f_container_bottom = f_container_top + parseInt($('#section-organizations-fighters').css('height').replace('px',''));
            get_current_page(window_top,window_bottom);
        //     if(window_bottom>=f_container_bottom&&isloading==0){
        //         $('.progress-bar-container').show();
        //         isloading = 1;
        //         $.ajax({
        //             url: window.location.origin+'/wp-admin/admin-ajax.php',
        //             dataType: 'json',
        //             type: 'POST',
        //             data: {
        //                 'action':'get_fighters',
        //                 'page':page,
        //                 'limit':limit,
        //                 'cat':cat
        //             },
        //             success: function(result){
        //                 current_path = base_path+page+'/';
        //                 if(result.length){
        //                     $('.fighter_container').append('<div class="row inline-page page-'+page+'" data-page="'+page+'"></div>');
        //                     var new_container = $('.fighter_container').find('.page-'+page);
        //                     $.each(result,function(i,f){
        //                          new_container.append('<div class="col-sm-6 col-md-4 container-fighters"><a href="'+f.link+'"><div class="thumbnail nopadding-bottom margin-bottom-0 noradius"><img class="img-responsive noradius" src="'+f.thumbnail+'" alt="'+f.title+'" /></div></a><div class="fighter-details"><a href="'+f.link+'"><h4 class="margin-bottom-0">'+f.title+'</h4></a><a href="#"><small class="block lbl-weightclass">'+f.weight+'</small></a><small>'+f.record+'</small></div></div>');
        //                     });
        //                      window.history.pushState("", "", current_path);
        //                     page += 1;
        //                     if(result.length==limit)
        //                         isloading=0;
        //                     $('.progress-bar-container').hide();
        //                 }else{
        //                     $('.progress-bar-container').hide();
        //                 }
                      
        //             },
        //             error: function(errorThrown){console.log(errorThrown);}
        //         });
        //     }
        });

        function get_current_page(window_top,window_bottom){
            $('.fighter_container').find('.inline-page').each(function(){
                var current_top = $(this).offset().top;
                var current_center = current_top+$(window).height()/2;
                if(window_top<=current_center&&window_bottom>=current_center){
                    var new_page = $(this).data('page');
                    if(old_page!=new_page){
                        var page_title = "Page: "+new_page+' | '+cur_title;
                        window.history.pushState("", page_title , base_path+new_page+'/');
                        document.title = page_title ;
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