// import Swiper bundle with all modules installed
import Swiper from 'swiper/bundle';
import 'swiper/swiper-bundle.css';

const swiper = new Swiper('.swiper-container', {
    loop: true,
    slidesPerView: 2,
    slidesPerGroup: 2,
    spaceBetween: 8,
    centeredSlides: false,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    // If we need pagination
    pagination: {
        el: '.swiper-pagination',
        type: "fraction",
    },
    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    }
});
