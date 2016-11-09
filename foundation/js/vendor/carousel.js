/*jslint devel: true, vars : true plusplus : true*/
/*global $*/
/*
 * author engintruder <engkwangseob@gmail.com>
 * license MIT
 * @module Simplecarousel(...)
 */
function Simplecarousel(rootClass, options) {
    'use strict';
    options = (typeof (options) !== 'undefined') ? options : {};
    var defaults = {
        auto : true,
        time : 7000,
        width : '700px',
        height : '600px',
        selectedSlider : '#000',
        unselectedSlider : '#fff',
        linkStyle : 'link-style'
    },
        sliderRoot = $('.' + rootClass),
        sliderArray = $('.' + rootClass).children(),
        intervalValue = null, i, num = 0, name;
    for (name in defaults) {        if (defaults.hasOwnProperty(name)) {
            if (options.hasOwnProperty(name)) {
                defaults[name] = options[name];
            }
        }
    }
    sliderRoot.width(defaults.width);
    sliderRoot.height(defaults.height);
    sliderRoot.append('<div class="paper-link"></div>');
    var paperLink = $('.paper-link');
    paperLink.css('position', 'relative');
    paperLink.css('width', defaults.width);
    paperLink.css('text-align', 'center');
    paperLink.css('top', defaults.height);
    for (i = 0; i < sliderArray.length; i += 1) {
        var bgUrl = $(sliderArray[i]).attr('data-image');
        $(sliderArray[i]).css('position', 'absolute');
        $(sliderArray[i]).css('background-image', 'url("' + bgUrl + '")');
        $(sliderArray[i]).css('background-repeat', 'no-repeat');
        $(sliderArray[i]).css('background-position', 'fixed');
        $(sliderArray[i]).css('background-size', '100% 100%');
        $(sliderArray[i]).css('width', defaults.width);
        $(sliderArray[i]).css('height', defaults.height);
        $(sliderArray[i]).css('word-break', 'break-all');
        paperLink.append('<a data-slide-index="' + i + '" href="#">' + (i + 1) + '</a>');
        if (i !== 0) {
            $(sliderArray[i]).hide();
        }
    }
    var paperLinkA = $('.paper-link a');
    paperLinkA.css('background', defaults.unselectedSlider);
    paperLinkA.css('text-indent', '-9999px');
    paperLinkA.css('display', 'inline-block');
    paperLinkA.css('width', '8px');
    paperLinkA.css('height', '8px');
    paperLinkA.css('margin', '0 5px');
    paperLinkA.css('outline', '0');
    paperLinkA.css('border-radius', '5px');
    paperLinkA.css('border-style', 'solid');
    paperLinkA.css('border-color', '#3c4458');
    paperLinkA.css('border-width', '1px');
    $(paperLinkA[0]).css('background', defaults.selectedSlider);
    function interval() {
        var srcSlider = $(sliderArray[num % sliderArray.length]),
            targetSliderNum = $(sliderArray[num % sliderArray.length]).attr('data-next');
        srcSlider.fadeOut();
        $(sliderArray[targetSliderNum]).fadeIn();
        paperLinkA.css('background', defaults.unselectedSlider);
        $(paperLinkA[targetSliderNum]).css('background', defaults.selectedSlider);
        num++;
    }
    function sliderEvent(src, target) {
        clearInterval(intervalValue);
        $(sliderArray[src]).fadeOut();
        $(sliderArray[target]).fadeIn();
        paperLinkA.css('background', defaults.unselectedSlider);
        $(paperLinkA[target]).css('background', defaults.selectedSlider);
        num = target;
        intervalValue = setInterval(interval, defaults.time);
    }
    if (defaults.auto) {
        intervalValue = setInterval(interval, defaults.time);
    }
    paperLinkA.click(function (event) {
        if (num % sliderArray.length !== Number($(this).attr('data-slide-index'))) {
            sliderEvent(num % sliderArray.length, $(this).attr('data-slide-index'));
        }
    });
    sliderRoot.click(function (event) {
        event.preventDefault();
        var clickTarget = event.target;
        if (clickTarget.className === defaults.linkStyle) {
            var url = $(clickTarget).attr('href'),
                width = $(window).width() - 100,
                height = $(window).height() - 50,
                posX = ($(window).width() - width) / 2,
                posY = ($(window).height() - height) / 2,
                options = ', location=0, resizable=0, status=0, scrollbars=yes',
                optionsFull = "width=" + width + ", height=" + height + ", top=" + posY + ", left=" + posX + options;
            window.open(url, '_blank', optionsFull);
        }
        if ($(clickTarget).context.nodeName === 'DIV' && clickTarget.className !== 'paper-link') {
            var val = $(clickTarget).attr('data-value'),
                nextNumber = $(clickTarget).attr('data-next');
            sliderEvent(val, nextNumber);
        }
    });
}