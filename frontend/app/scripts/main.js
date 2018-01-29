function activateTab() {
    var tabId = window.location.hash;

    if(tabId != '') {
        disableTabs();
        disableLinks();

        $(tabId).addClass('active');
        $('a[href="' + tabId + '"]').parent().addClass('active');
    }
}

function disableTabs() {
    $('.content .tab').each(function () {
        $(this).removeClass('active');
    });
}

function disableLinks() {
    $('.nav .item').each(function () {
        $(this).removeClass('active');
    });
}

$(window).on('hashchange', function () {
    activateTab();
});

$(document).ready(function() {
    activateTab();
});