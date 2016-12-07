/**
 * Created by Administrator on 2016/7/25 0025.
 */
jQuery(document).ready(function($) {
    var fixPerspect = function() {
        var w = $(window).width(), h;
        if (w < 768) {
            h = (w + 768) / 2.7537;
        } else {
            h = w / 1.3727;
        }
        $('#banner').css('height', h + 'px');
        var fontSize = h * 0.4 / 3;
        $('#title h1').css('font-size', fontSize + 'px');
    };
    fixPerspect();
    $(window).resize(fixPerspect);

    // Lossy WebP support detection
    var lwp = new Image();
    lwp.onerror = function() {
        $('[data-bg]').each(function() {
            $(this).css('background-image', 'url(' + $(this).attr('data-bg') + ')');
        });
        $('img[data-src]').each(function() {
            $(this).attr('src', $(this).attr('data-src'));
        });
    };
    lwp.onload = function() {
        $('[data-webpbg]').each(function() {
            $(this).css('background-image', 'url(' + $(this).attr('data-webpbg') + ')');
        });
        $('img[data-webp]').each(function() {
            $(this).attr('src', $(this).attr('data-webp'));
        });
    };
    lwp.src = 'data:image/webp;base64,UklGRiIAAABXRUJQVlA4IBYAAAAwAQCdASoBAAEADsD+JaQAA3AAAAAA';

    $('#menu-icon').click(function() {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $('#menu').stop().slideUp(300);
        } else {
            $(this).addClass('active');
            $('#menu').stop().slideDown(300);
        }
    });

    if ($('#index').length == 0) {
        $('.menu .current').removeClass('current');
    }
    if ($('#code').length > 0) {
        $('#menu-code').addClass('current');
    }
    if ($('#download').length > 0) {
        $('#menu-download').addClass('current');
    }
});