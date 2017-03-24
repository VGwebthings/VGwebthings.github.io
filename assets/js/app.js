var loadScripts = function () {
    var footer = $('footer');
    $('body').css('opacity', '1');
    $('.header__search-icon').on('click', function (event) {
        event.preventDefault();
        $('.header__search').toggleClass('is-showing');
    });
    $('a[href*=\\#]').on('click', function (event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: $(this.hash).offset().top
        }, 500);
    });
    //new Clipboard('.btn');
    // $('#search-query').lunr({
    //     indexUrl: '/search.json',
    //     results: '#search-results',
    //     entries: '.entries',
    //     template: '#search-results-template'
    // });
    var idx = lunr(function () {
        this.field('category');
        this.field('content');
        this.field('id');
        this.field('title', {boost: 10});
    });
};
window.addEventListener('load', loadScripts);
