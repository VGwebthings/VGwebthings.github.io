require('../scss/app.scss');
require('smoothscroll-for-websites');
var $ = require('jquery');
var lunr = require('lunr');
require('./components/_search');
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
    // setTimeout(function () {
    //     $('#search').focus();
    //     $('#search').blur();
    // }, 250);
}

function getSearchData() {
    // console.log(index.documentStore.length);
    $.get('/search.json', function (response) {
        var index = populateIndex(response);
        var snippets = snippetsIndex(response);
        $('#search').on('keydown', function (e) {
            var query;
            var results;
            if (e.keyCode === 13) {
                $('#search__results').empty();
                query = $(this).val();
                results = index.search(query);
                results.forEach(function (result, index) {
                    $('#search__results').append('<li class="search__result"><a href="' + snippets[result.ref].url + '">' + snippets[result.ref].title + '</a></li>');
                });
                // searchIndex.search($('#search').val()).forEach(function (result, index) {
                //     //$('.search-results-list').append(template(post(result.ref)));
                //     console.dir(result);
                // });
            }
        });
    });
}

function populateIndex(searchData) {
    var searchIndex = lunr(function () {
        this.field('content');
        this.field('description');
        this.field('tags');
        this.field('title', {boost: 10});
        this.ref('id');
    });
    searchData.forEach(function (item, index) {
        searchIndex.add({
            "id": index,
            "content": item.content,
            "description": item.description,
            "tags": item.tags,
            "title": item.title
        });
    });
    console.dir(searchIndex);
    return searchIndex;
}

function snippetsIndex(searchData) {
    var snippets = [];
    searchData.forEach(function (item) {
        snippets.push(item);
    });
    return snippets;
}

var loadScripts = function () {
    getSearchData();
    $('body').css('opacity', '1');
    $('.header__search-icon').on('click', function (e) {
        openSearch();
        e.preventDefault();
    });
    $(window).keydown(function (e) {
        if ((e.metaKey || e.ctrlKey) && e.keyCode === 83) {
            openSearch();
            e.preventDefault();
        }
        if (e.keyCode === 27) {
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
    if (header) {
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
    }
};
window.addEventListener('load', loadScripts);
