$(document).ready(function(){
    $('.carrousel_post').slick({
        infinite: true,
        slidesToShow: 4,           // Default untuk layar besar (lg)
        slidesToScroll: 1,
        autoplay: false,
        responsive: [
            {
                breakpoint: 1024,   // Untuk layar medium (md)
                settings: {
                    slidesToShow: 2,   
                    slidesToScroll: 1,
                    infinite: true,
                    autoplay: true,
                    autoplaySpeed: 4000
                }
            },
            {
                breakpoint: 768,    // Untuk layar kecil (sm)
                settings: {
                    slidesToShow: 1,   
                    slidesToScroll: 1,
                    infinite: true,
                    autoplay: true,
                    autoplaySpeed: 4000
                }
            }
        ]
    });

    $('.slider').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,          
        arrows: false,        
        autoplay: true,
        autoplaySpeed: 4000
      });

    $('#btn_next').on("click", function(){
        $('.carrousel_post').slick('slickNext')
    })
    $('#btn_prev').on("click", function(){
        $('.carrousel_post').slick('slickPrev')
    })
})

