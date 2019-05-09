$(document).ready(function(){

    /*-----------------------------------------------------------------
     - Dropdown
     -----------------------------------------------------------------*/
    $('.dropdown-toggle').click(function(e) {
        e.preventDefault();
        if($(this).next('.menu').hasClass('active')){
            $('.dropdown-toggle').removeClass('active').next('.menu').removeClass('active');
        } else {
            $('.dropdown-toggle').removeClass('active').next('.menu').removeClass('active');
            $(this).addClass('active').next('.menu').addClass('active');
        }

    });

    $(document).click(function(e) {
        var target = e.target;
        if (!$(target).is('.dropdown-toggle') && !$(target).parents().is('.dropdown-toggle')) {
            $('.dropdown-menu').removeClass('active');
        }
    });


    /*-----------------------------------------------------------------
    - Sidebar Submenu
    -----------------------------------------------------------------*/
    $('ul#sidemenu li.has-sub > a').click(function(e) {
        e.preventDefault();
        $(this).parent('li').toggleClass('active').find('ul').slideToggle();
    });


    /*-----------------------------------------------------------------
    - Panel Toggle
    -----------------------------------------------------------------*/
    $(document).on('click', '.panel-toggle', function(e) {
        e.preventDefault();
        $(this).closest('section.panel').toggleClass('closed');
    });



    /*-----------------------------------------------------------------
    - Menu Toggle
    -----------------------------------------------------------------*/
    $('#sidebar-toggle').click(function(e) {
        e.preventDefault();
        var add_class = 'toggled';
        $(this).toggleClass(add_class);
        $('#sidebar').toggleClass(add_class);
        $('.wrapper').toggleClass(add_class);
        $('#site-logo').toggleClass(add_class);
    });

    $('#res-sidebar-toggle').click(function(e) {
        e.preventDefault();
        $('#sidebar').toggleClass('active');
    });

    /*-----------------------------------------------------------------
     - Fullscreen Toggle
     -----------------------------------------------------------------*/
    $('#fullscreen-toggle').click(function(e) {
        e.preventDefault();
        $(this).toggleClass('icon-expand icon-compress');
        $(document).toggleFullScreen();
    });


    /*-----------------------------------------------------------------
     - Alert Close
     -----------------------------------------------------------------*/
    $('.alert a.alert-close').click(function(e) {
        e.preventDefault();
        if($(this).hasClass('slide')){
            $(this).parent('.alert').slideUp('normal', function () {
                $(this).remove();
            });
        } else {
            $(this).parent('.alert').remove();
        }
    });


    /*-----------------------------------------------------------------
    - Modal
    -----------------------------------------------------------------*/
    $('.modal-trigger').on('click', function(e) {
        e.preventDefault();
        var target = '#' + $(this).attr('data-modal');
        $( '<div class="modal-bg"></div>' ).insertAfter( target );
        $('body').addClass('modal-open');
        $(target).addClass('open');
        $('.modal-bg').addClass('open');
    });
    $(document).on('click', '.modal-bg', function(e) {
        e.preventDefault();
        $('body').removeClass('modal-open');
        $('.modal').removeClass('open');
        $('.modal-bg').removeClass('open');
        $('.modal-bg').remove();
    });


    /*-----------------------------------------------------------------
    - Wrapper Min Height
    -----------------------------------------------------------------*/
    wrapperHeight();
    $(window).resize(function() {
        wrapperHeight();
    });

    function wrapperHeight() {
        $(".wrapper").css({ minHeight: $(window).innerHeight() + 'px' });
    }

    /*-----------------------------------------------------------------
    - Tagging
    -----------------------------------------------------------------*/
    var tag_options = {
        "edit-on-delete": false,
        "no-del": true,
        "no-backspace": true,
        "no-spacebar": true
    };
    $(".tags-input").tagging(tag_options);


    /*-----------------------------------------------------------------
     - Tabs
     -----------------------------------------------------------------*/
    $('ul.tabs-titles > li:first-child').addClass('active');
    $('ul.tabs-contents > li:first-child').addClass('active');

    $('ul.tabs-titles > li > a').on('click', function(e) {
        e.preventDefault();
        var target = $(this).attr('href');
        $(this).parent('li').parent('ul').find('li').removeClass('active');
        $(this).parent('li').addClass('active');
        $(target).parent('ul').find('li').removeClass('active');
        $(target).addClass('active');
    });

    /*-----------------------------------------------------------------
     - Modal
     -----------------------------------------------------------------*/
    $('[data-modal]').on('click', function(e) {
        e.preventDefault();
        var target = $(this).attr('data-modal');
        if (!target.match("^#")) {
            target = '#' + target;
        }
        $('body').addClass('modal-open');
        $(target).addClass('open');

        $( 'body' ).append( '<div class="overlay"></div>' );
        setTimeout(function(){
            $('.overlay').addClass('open');
        }, 10);
    });
    $(document).on('click', '.overlay', function(e) {
        e.preventDefault();
        $('body').removeClass('modal-open');
        $('.modal').removeClass('open');

        $('.overlay').removeClass('open');
        setTimeout(function(){
            $('.overlay').remove();
        }, 300);
    });


    /*-----------------------------------------------------------------
     - Checkbox All Toggle
     -----------------------------------------------------------------*/
    $('.checkbox-all-toggle > input').on('click', function () {
        var group = $(this).parents().eq(2);
        if ($(this).is(':checked')) {
            $(group).find('input').prop("checked", true);
        } else {
            $(group).find('input').prop("checked", false);
        }
    });

    /*-----------------------------------------------------------------
    - Upload Preview
    -----------------------------------------------------------------*/
    function readURL(input, preview) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(preview).find('span').text('تغییر فایل');
                $(preview).css('background-image', 'url(' + e.target.result + ')');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".select-file.image input").change(function(){
        var parent = $(this).parents().eq(1);
        if($(this).val() == ''){
            $(parent).find('span').text('انتخاب فایل');
            $(parent).css('background-image', 'none');
        } else {
            readURL(this, parent);
        }
    });

    /*-----------------------------------------------------------------
    - Edit Slug
    -----------------------------------------------------------------*/
    $('.slug .edit-slug').on('click', function (e) {
        var slug = $(this).next('.slug-content');
        var end = $(slug).find('.end');
        if( $(this).hasClass('icon-pencil') ){
            var input = $('<input />', {
                'type': 'text',
                'class': 'slug-input xs',
                'value': $(end).html()
            });
            $(end).text('').append(input);
            input.focus();
        } else {
            var input = $(slug).find('.slug-input');
            var span = $('<span />', {
                'class': 'end'
            });
            $(end).text($(input).val());
        }
        $(this).parent('.slug').toggleClass('editing');
        $(this).toggleClass('icon-pencil icon-check green');
    });


    /*-----------------------------------------------------------------
     - nestedSortable
     -----------------------------------------------------------------*/
    var nested_config = {
        handle: 'section',
        items: 'li',
        rtl: true,
        maxLevels: 3,
        toleranceElement: '> section',

        forcePlaceholderSize: true,
        helper:	'clone',
        opacity: .6,
        placeholder: 'placeholder',
        revert: 250,
        tabSize: 25,
        tolerance: 'pointer',

        isTree: true,
        expandOnHover: 700,
        startCollapsed: true,
    };

    $('.sortable').nestedSortable(nested_config);


    /*-----------------------------------------------------------------
     - Add to menu
     -----------------------------------------------------------------*/
    $('a[href="#add-menu-item"]').on('click', function (e) {
        e.preventDefault();
        var menu = $(this).attr('data-target');
        var panel = $(this).parents().eq(2);

        var link = $(panel).find('input[name="link"]').val();
        var title = $(panel).find('input[name="title"]').val();
        var target = '';
        if ($(panel).find('input[name="target"]').is(':checked')) { target = 'checked'; }

        var template = '<li><section class="panel closed small menu-item"> <header> <div class="title"> <small>'+title+'</small> </div><div class="functions"> <a class="panel-toggle" href="#"></a> </div></header> <article> <div class="field"> <label for="link">لینک آیتم</label> <input name="link" type="text" value="'+link+'"> </div><div class="field"> <label for="title">تیتر آیتم</label> <input name="title" type="text" value="'+title+'"> </div><div class="checkbox"> <input id="target" type="checkbox" name="target" value="1" '+target+'> <label for="target"> بازشدن در تب جدید </label> </div></article> <footer class="tal"> <a href="#delete-menu-item" class="color-red"> حذف </a> </footer></section></li>';
        $(menu).append(template).each(function() {
            $(document).find('.sortable').each(function( index ) {
                $( this ).nestedSortable(nested_config);
            });
            $(panel).find('input[name="link"]').val('');
            $(panel).find('input[name="title"]').val('');
            $(panel).find('input[name="target"]').prop('checked', false);
        });;

    });


    /*-----------------------------------------------------------------
     - Remove From Menu
     -----------------------------------------------------------------*/
    $(document).on('click','a[href="#delete-menu-item"]', function (e) {
        e.preventDefault();
        var item = $(this).parents().eq(2);

        $(item).remove().each(function() {
            $(document).find('.sortable').each(function( index ) {
                $( this ).nestedSortable(nested_config);
            });
        });;

    });


    /*-----------------------------------------------------------------
     - Tinymce
     -----------------------------------------------------------------*/
    tinymce.init({
        selector: '.editor',
        directionality : 'rtl',
        language: 'fa_IR',
        height: 400,
        theme_advanced_toolbar_align : "right",
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | rtl ltr',
        toolbar2: 'link image | print preview media | forecolor backcolor',
        image_advtab: true,
        setup: function(ed){
            if(ed.getElement().hasAttribute('height') && ed.getElement().getAttribute('height') != 'auto'){
                ed.settings.height = ed.getElement().getAttribute('height');
            }
            if(ed.getElement().hasAttribute('direction')){
                ed.settings.directionality = ed.getElement().getAttribute('direction');
            }
        }
    });
});