var didScroll = false;
var header = document.getElementById('header');
var content = document.getElementById('content');

function changeHeader() {
    var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
    header.classList.toggle('header--scrolled', scrollTop >= (content.offsetTop - 50));
}

function openSearch() {
    $('body').toggleClass('no-scroll');
    $('.header__search-icon').toggleClass('is-showing');
    $('.header__search').toggleClass('is-showing');
    setTimeout(function () {
        $('#search').focus();
    }, 250);
}

var loadScripts = function () {
    $('body').css('opacity', '1');
    $('.header__search-icon').on('click', function (e) {
        openSearch();
        e.preventDefault();
    });
    $(window).keydown(function (e) {
        if ((e.metaKey || e.ctrlKey) && e.keyCode == 83) {
            openSearch();
            e.preventDefault();
        }
        if (e.keyCode == 27) {
            openSearch();
            e.preventDefault();
        }
    });
    $('a[href*=\\#]').on('click', function (event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: $(this.hash).offset().top
        }, 500);
    });
    $(window).scroll(function () {
        didScroll = true;
    });
    setInterval(function () {
        if (didScroll) {
            didScroll = false;
            changeHeader();
        }
    }, 100);
    changeHeader();
    //new Clipboard('.btn');
    // $('#search-query').lunr({
    //     indexUrl: '/search.json',
    //     results: '#search-results',
    //     entries: '.entries',
    //     template: '#search-results-template'
    // });
    // var idx = lunr(function () {
    //     this.field('category');
    //     this.field('content');
    //     this.field('id');
    //     this.field('title', {boost: 10});
    // });
};
window.addEventListener('load', loadScripts);
