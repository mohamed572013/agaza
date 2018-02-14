    $(window)['scroll'](function () {
        'use strict';
        if ($(this)['scrollTop']() > 1) {
            $('header')['addClass']('sticky')
        } else {
            $('header')['removeClass']('sticky')
        }
    });
    $(window)['scroll']();

    function toggleChevron(_0xf709x2) {
        'use strict';
        $(_0xf709x2['target'])['prev']('.panel-heading')['find']('i.indicator')['toggleClass']('icon_plus_alt2 icon_minus_alt2')
    }
    $('.panel-group')['on']('hidden.bs.collapse shown.bs.collapse', toggleChevron);
    $(function () {
        'use strict';
        new WOW()['init']();
        $('.video')['magnificPopup']({
            type: 'iframe'
        });
        $('.parallax_window_in')['parallax']({});
        $('.magnific-gallery')['each'](function () {
            $(this)['magnificPopup']({
                delegate: 'a',
                type: 'image',
                gallery: {
                    enabled: true
                }
            })
        });
        $('.dropdown-menu')['on']('click', function (_0xf709x2) {
            _0xf709x2['stopPropagation']()
        });
        var _0xf709x3 = $('#cat_nav')['find']('li a');
        _0xf709x3['on']('click', function () {
            'use strict';
            _0xf709x3['removeClass']('active');
            $(this)['addClass']('active')
        });
        $('.tooltip-1')['tooltip']({
            html: true
        });
        var _0xf709x4 = $('#box_subscribe')['find']('ul li a');
        _0xf709x4['on']('click', function () {
            'use strict';
            _0xf709x4['removeClass']('active');
            $(this)['addClass']('active')
        });
        var _0xf709x5 = $('#filters_col')['find']('.collapse');
        if ($(this)['width']() < 991) {
            _0xf709x5['removeClass']('in');
            _0xf709x5['addClass']('out')
        } else {
            _0xf709x5['removeClass']('out');
            _0xf709x5['addClass']('in')
        }
        ;
        var _0xf709x6 = document['querySelectorAll']('.cmn-toggle-switch');
        for (var _0xf709x7 = _0xf709x6['length'] - 1; _0xf709x7 >= 0; _0xf709x7--) {
            var _0xf709x8 = _0xf709x6[_0xf709x7];
            _0xf709x9(_0xf709x8)
        }
        ;

        function _0xf709x9(_0xf709x8) {
            _0xf709x8['addEventListener']('click', function (_0xf709x2) {
                _0xf709x2['preventDefault']();
                (this['classList']['contains']('active') === true) ? this['classList']['remove']('active') : this['classList']['add']('active')
            })
        }
    });
    $('.qtyplus')['click'](function (_0xf709x2) {
        _0xf709x2['preventDefault']();
        fieldName = $(this)['attr']('name');
        var _0xf709xa = parseInt($('input[name=' + fieldName + ']')['val']());
        if (!isNaN(_0xf709xa)) {
            $('input[name=' + fieldName + ']')['val'](_0xf709xa + 1)
        } else {
            $('input[name=' + fieldName + ']')['val'](1)
        }
    });
    $('.qtyminus')['click'](function (_0xf709x2) {
        _0xf709x2['preventDefault']();
        fieldName = $(this)['attr']('name');
        var _0xf709xa = parseInt($('input[name=' + fieldName + ']')['val']());
        if (!isNaN(_0xf709xa) && _0xf709xa > 0) {
            $('input[name=' + fieldName + ']')['val'](_0xf709xa - 1)
        } else {
            $('input[name=' + fieldName + ']')['val'](0)
        }
    });
    $('.box_info a[href^="#"]')['on']('click', function (_0xf709x2) {
        _0xf709x2['preventDefault']();
        var _0xf709xb = this['hash'];
        var _0xf709xc = $(_0xf709xb);
        $('html, body')['stop']()['animate']({
            "\x73\x63\x72\x6F\x6C\x6C\x54\x6F\x70": _0xf709xc['offset']()['top'] - 80
        }, 600, 'swing', function () {
            window['location']['hash'] = _0xf709xb
        })
    })


    $(document).ready(function () {

        $("#owl-demo").owlCarousel({
            autoPlay: 0,
            autoplay: true,
            autoplayTimeout: 1000,
            autoplayHoverPause: true,
            loop: true,
            items: 4, //10 items above 1000px browser width
            itemsDesktop: [1000, 4], //5 items between 1000px and 901px
            itemsDesktopSmall: [900, 3], // betweem 900px and 601px
            itemsTablet: [600, 2], //2 items between 600 and 0;
            itemsMobile: false // itemsMobile disabled - inherit from itemsTablet option
        });

    });