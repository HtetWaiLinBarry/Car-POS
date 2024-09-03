$(document).ready(function () {
    $('.my-claint').owlCarousel({
        center: true,
        loop: true,
        margin: 10,
        nav: true,
        items: 3,
        autoplayTimeout: 6000,
//        autoplay: true,
        responsive: {
            0: {
                center: false,
                items: 2,
                nav: true
            },
            768: {
                center: true,
                items: 3,
                nav: true
            },
            850: {
                items: 3,
                nav: true
            }
        },
        navText: [
        "<i class=\"fa fa-angle-left\" aria-hidden=\"true\"></i>",
        "<i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>"],
    });



    $('section.works .work-images .overlay-text i').on('click', function () {
        $(this).parent().hide();
    })
});