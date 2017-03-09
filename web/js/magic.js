// FUNCTIONS
function stickyFooter(){
    // make body margin bottom the height of footer
    $('body').css('margin-bottom', ($('footer').outerHeight() + 20) + 'px');
}

// EVENTS & LISTENERS
$(document).ready( stickyFooter );
$(window).resize( stickyFooter );
