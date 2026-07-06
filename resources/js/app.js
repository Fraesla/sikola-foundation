import './bootstrap';

import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()

document.addEventListener('DOMContentLoaded', () => {

    const heroSwiper = document.querySelector('.heroSwiper');

    if (heroSwiper) {

        new Swiper('.heroSwiper', {
            modules: [Navigation, Pagination, Autoplay],

            loop: true,

            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },

            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },

            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    }

});