var i = 0;

function changeSlide(){

    var pages = [
        "main",
        "aquarium",
        "shopping",
        "food",
        "kids",
        "ice-shows",
        "theater",
        "music"
    ];

    i += 1;
    if (i > 7) {i = 0}

    $("#teaser-icon").removeClass(pages[i-1]).removeClass(pages[pages.length-1]).addClass(pages[i]);
    $('.name_slide').html(pages[i]);
}

function hideGuides() {
    $('.guide1').hide();
    $('.guide2').hide();
}