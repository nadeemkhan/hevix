var i = 0;

function changeSlide(){

    var pages = [
        "main",
        "aquarium",
        "parking",
        "food",
        "theater",
        "street-art",
        "music",
        "kids"
//        "ice-shows",
//        "sport",
//        "cinema"
    ];

    i += 1;
    if (i > 7) {i = 0}

    $(".wrapper").removeClass(pages[i-1]).removeClass(pages[pages.length-1]).addClass(pages[i]);
}