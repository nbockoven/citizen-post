// GLOBAL VARIABLES
var ARTICLES,
    CURRENT_ARTICLE,
    CURRENT_ARTICLE_POSITION,
    CURRENT_LISTING_ARTICLE,
    SCREEN_TOP,
    OFFSET = 0,
    SourceListing = $('#template-article-listing').html(),
    SourceDetail = $('#template-article-detail').html(),
    templateListing = Handlebars.compile( SourceListing ),
    templateDetail = Handlebars.compile( SourceDetail )
    ARTICLE_LISTING = $('#article-listing'),
    ARTICLE_DETAIL = $('#article-detail')
    PROCESSING = '<div class="progress my-3"><div class="progress-bar progress-bar-striped progress-bar-animated w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>',
    HEADER_HEIGHT = $('header').outerHeight();


// FUNCTIONS
function stickyFooter(){
  // make body margin bottom the height of footer
  $('body').css('margin-bottom', $('footer').outerHeight() + 'px');
}






function getArticles(){
  ARTICLES = $('[data-view-canonical]');
}

function setScreenTop(){
  SCREEN_TOP = $(window).scrollTop();
}

function setCurrentArticleURL(){
  // set the URL to current article canonical (data-view-canonical)
  history.pushState({fake: 'news'}, 'listing', '/' + getCurrentArticle());
}

function getCurrentArticle(){ // get the current article by window position
  // get article bodies on document
  $.each(ARTICLES, function( i, article ){
    var position = getArticlePosition( article );
    if( SCREEN_TOP < position.bottom ){ // most likely the current article?
      CURRENT_ARTICLE = article;
      CURRENT_ARTICLE_POSITION = position;
      CURRENT_LISTING_ARTICLE = $('[data-listing-canonical="'+CURRENT_ARTICLE.canonical+'"]');
      CURRENT_LISTING_ARTICLE.css('background-color', 'white'); // set background color of current listing
      return false;
    }
  });
  return CURRENT_ARTICLE['canonical']; // return canonical
}

function getArticlePosition( article ){
  var position    = {};
  article = $(document).find('[data-view-canonical="'+article.canonical+'"]').eq(0);
  position.top    = article.offset().top;
  position.bottom = position.top + article.outerHeight();
  return position;
}

function getArticlePercentScrolled(){
  // calculate percent of article scrolled
  var percentage = Math.ceil( (SCREEN_TOP / CURRENT_ARTICLE_POSITION.bottom) * 100 );
  return percentage;
}

function scrollListing( percentage ){
  // scroll listing article(s) by the same percentage as current article
  if( percentage >= 100 ){
    CURRENT_LISTING_ARTICLE.hide();
  }
  else{
    CURRENT_LISTING_ARTICLE.removeClass('bg-white').css('background', 'repeating-linear-gradient(to bottom, green, green '+percentage+'%, white 0, white)');
  }
}





// I don't need to fetch the articles again until the user scrolls past 20 results.
function loadArticles( offset ){
  return $.ajax({
    type: 'GET',
    url: '/',
    dataType: 'json',
    beforeSend: function(){ ARTICLE_DETAIL.append( PROCESSING ); },
    complete: function(){ ARTICLE_DETAIL.find('.progress').remove(); },
    success: function( articles ){
      ARTICLES = articles;
      if( articles.length ){
        // populate listing
        $.each(articles, function( i, article ){
          article.body = new Handlebars.SafeString( article.body ); // allow html tags in string
          // add to listing div
          ARTICLE_LISTING.append( templateListing( article ) );
          // add to detail div
          ARTICLE_DETAIL.append( templateDetail( article ) );
        });
      }
      else{
        ARTICLE_DETAIL.html( 'No articles found.' );
      }
    }
  });
}



function positionListing(){
  // if window scrollTop is less than header position, attach article listing to the bottom of it,
  // else it's to be attached to top of screen
  setScreenTop();
  if( SCREEN_TOP < HEADER_HEIGHT )
    ARTICLE_LISTING.css('top', ( HEADER_HEIGHT - SCREEN_TOP ) + 'px');
  else
    ARTICLE_LISTING.css('top', 0);
}




// EVENTS & LISTENERS
$(document).ready(function(){
    $.when( loadArticles( OFFSET ) )
      .then(function(){
        positionListing();
        stickyFooter();
        setCurrentArticleURL();
      });
  })
  .resize( stickyFooter );

$(window)
  .resize(function(){
    stickyFooter();
    positionListing();
  })
  .scroll(function(){
    positionListing();
    setCurrentArticleURL();
    scrollListing( getArticlePercentScrolled() );
  });
