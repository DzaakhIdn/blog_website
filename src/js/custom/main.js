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
                    autoplay: false
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
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        prevArrow: '#btn_left',
        nextArrow: '#btn_right'
    });
    $('.mobile_tags').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4500
    });

    $('.large_tags').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        infinite: false,
        prevArrow: '#prev_tags',
        nextArrow: '#next_tags'
    });
    function checkArrow(currentSlides, totalSlides){
        if(currentSlides == 0){
            $('#prev_tags').prop('disabled', true).addClass('hidden')
            $('.penutup_kiri').prop('disabled', true).addClass('hidden')
        }else{
            $('#prev_tags').prop('disabled', false).removeClass('hidden')
            $('.penutup_kiri').prop('disabled', false).removeClass('hidden')
        }

        if(currentSlides == totalSlides - 1){
            $('#next_tags').prop('disabled', true).addClass('hidden')
            $('.penutup_kanan').prop('disabled', true).addClass('hidden')
        }else{
            $('#next_tags').prop('disabled', false).removeClass('hidden')
            $('.penutup_kanan').prop('disabled', false).removeClass('hidden')
        }
    }

    $('.large_tags').on('afterChange', function(event, slick, currentSlides){
        const totalSlides = slick.slideCount;
        checkArrow(currentSlides, totalSlides)
    });

    checkArrow(0, $('.large_tags').slick('getSlick').slideCount);

    $('#btn_next').on("click", function(){
        $('.carrousel_post').slick('slickNext')
    })
    $('#btn_prev').on("click", function(){
        $('.carrousel_post').slick('slickPrev')
    })
})


