---
---
```js
console.log('--- _scroll.js');
$('.do-scroll-to-top').on('click', function (e) {
    $('html, body').animate({scrollTop: 0}, 800);
    e.preventDefault();
});
```
