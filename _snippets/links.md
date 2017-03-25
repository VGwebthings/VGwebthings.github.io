---
---
```js
var Velocity = require('velocity-animate');
(function ($) {
    $(function () {
        Velocity($('body'), {opacity: 1}, {duration: 250, easing: 'ease-in-out'});
        $('a:not(.normal-link)').on('click', function (e) {
            var link = $(this).attr('href');
            Velocity($('body'), {opacity: 0}, {duration: 350, easing: 'ease-in-out'});
            setTimeout(function () {
                window.location.href = link;
            }, 350);
            e.preventDefault();
        });
    });
    //$(window).load(function () {
    //    Velocity($('body'), {opacity: 1}, {duration: 500, easing: 'ease-in-out'});
    //});
})(jQuery);
```