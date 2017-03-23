// FUNCTIONS
function stickyFooter(){
    // make body margin bottom the height of footer
    $('body').css('margin-bottom', $('footer').outerHeight() + 'px');
}








function setCurrentArticleURL( pathname ){
    // set the URL to current article canonical (data-view-id)
    CURRENT_ARTICLE = pathname;
    location.pathname = '/' + CURRENT_ARTICLE;
}

function getCurrentArticle(){
    // get the current article by URL
    var pathname = location.pathname.replace('/');
    if( CURRENT_ARTICLE !== pathname )
        setCurrentArticleURL( pathname );
}



function getListingArticleHeight( canonical ){
    ARTICLE_LISTING_HEIGHT = $('[data-listing-id="'+canonical+'"]').outerHeight();
}

function getArticlePercentScrolled(){
    // get top position of window
    var position = $(window).scrollTop();
    // get top position of article
    var top = CURRENT_ARTICLE.offset().top;
    // get ranged position of article
    var range = top + CURRENT_ARTICLE.outerHeight();

    var articlePercent = position / range;
    console.log( articlePercent );
}

function proportionallyScrollSideListingByCurrentArticle(){
    //
}



function sideListScroll(){
    // get the article that's at the top of the screen

}

// EVENTS & LISTENERS
$(document).ready(function(){
    stickyFooter();
    setCurrentArticleURL();
});

$(window)
    .resize( stickyFooter )
    .scroll( getArticlePercentScrolled );
