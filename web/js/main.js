$(document).ready(function () {
    // 侧导航下拉
    $('.nav-parent > a').on('click', function () {
        var parent = $(this).parent();
        var sub = parent.find('> ul');
        if (sub.is(':visible')) {
            sub.slideUp();
        } else {
            sub.slideDown();
        }
    })
    
    // 侧导航隐藏
    $('.toggle-sidebar').on('click', function (){
        var topnavpanel = $('.nav-top-main');
        var sidebarpanel = $('.side-bar-main');
        var contentpanel = $('.content-main');
        console.log(contentpanel.css('paddingLeft'))
        if (contentpanel.css('paddingLeft') == '0px') {
            sidebarpanel.animate({left: '0'});
            contentpanel.animate({'paddingLeft': '200px'});
            topnavpanel.animate({'paddingLeft': '200px'});
        } else {
            sidebarpanel.animate({left: '-200px'});
            contentpanel.animate({'paddingLeft': 0});
            topnavpanel.animate({'paddingLeft': 0});
        }
    })
    
    //当前菜单展开
    currentExpand();
    function currentExpand(){
       $('.nav-children').css({'display': 'none'});
       var childLevel = $('.side-bar-menu .nav-parent.active').length, obj = '.side-bar-menu';
       for(var i = 0; i < childLevel; i++){
           obj += ' .active';
           if($(obj).closest('.nav-children').length) $(obj).closest('.nav-children').removeAttr('style');
       }
    }
})
    