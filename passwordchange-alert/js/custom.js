 // Calling the function
$(function() {
    $('.toggle-nav').click(function() {
        toggleNavigation();
    });
    $('#content').click(function() {
        toggleNavigation2();
    });
});


// The toggleNav function itself
function toggleNavigation() {
    if ($('#container').hasClass('display-nav')) {
        // Close Nav
        $('#container').removeClass('display-nav');
    } else {
        // Open Nav
        $('#container').addClass('display-nav');
    }
}

function toggleNavigation2() {
    if ($('#container').hasClass('display-nav')) {
        // Close Nav
        $('#container').removeClass('display-nav');
    } 
}


