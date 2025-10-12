var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!************************************!*\
  !*** ./dev/js/components/_vars.js ***!
  \************************************/

})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!*****************************************!*\
  !*** ./dev/js/components/_functions.js ***!
  \*****************************************/
/* ЯНДЕКС КАРТЫ ДЛЯ КОНТАКТОВ */

let map = document.getElementById("map");
if (map) {
    function init() {
        const map = new ymaps.Map("map", {
            center: [53.64865063717227, 55.939788059524524],
            zoom: 16
        });

        const placemark = new ymaps.Placemark([53.64865063717227, 55.939788059524524], {}, {
        });

        map.controls.remove("geolocationControl");
        map.controls.remove("searchControl");
        map.controls.remove("trafficControl");
        map.controls.remove("typeSelector");
        map.controls.remove("fullscreenControl");
        map.controls.remove("zoomControl");
        map.controls.remove("rulerControl");
        map.geoObjects.add(placemark);
    }
    ymaps.ready(init);
}

// Красим активные пункты меню
if (!document.body.classList.contains("admin-layout")) {
    const currentPath = window.location.pathname;
    const headerMenuItem = document.querySelectorAll(".header__nav-link");
    const headerBurgerItem = document.querySelectorAll(".header__burger-link");
    const footerMenuItem = document.querySelectorAll(".footer__item-link");
    const menuLength = headerMenuItem.length;

    for (let i = 0; i < menuLength; i++) {
        // Получаем только путь из href
        const menuPath = new URL(headerMenuItem[i].href).pathname;
        if (menuPath === currentPath) {
            headerMenuItem[i].className = "active header__nav-link";
            if (headerBurgerItem[i]) headerBurgerItem[i].className = "active header__burger-link";
            if (footerMenuItem[i]) footerMenuItem[i].className = "active footer__item-link";
        }
    }
}

/* БУРГЕР МЕНЮ */

const burgerButton = document.querySelector(".burger-button");
const burgerMenu = document.querySelector(".burger-menu");

function toggleBurger() {
    burgerButton.classList.toggle("active");
    burgerMenu.classList.toggle("active");
}

window.addEventListener("resize", (function () {
    if (window.innerWidth > 1024 && burgerButton.classList.contains("active")) {
        burgerButton.classList.remove("active");
        burgerMenu.classList.remove("active");
    }
}
));

burgerButton.addEventListener("click", toggleBurger);


/* МОДАЛКА С ТРЕНЕРАМИ */

document.addEventListener("DOMContentLoaded", function () {
    // Открытие модалки
    document.querySelectorAll(".coaches__item-link").forEach(function (link) {
        link.addEventListener("click", function (e) {
            e.preventDefault();
            // Закрыть все открытые модалки
            document.querySelectorAll(".coaches__modal.active").forEach(function (modal) {
                modal.classList.remove("active");
            });
            // Открыть нужную
            var modalId = this.getAttribute("href");
            var modal = document.querySelector(modalId);
            if (modal) {
                modal.classList.add("active");
            }
        });
    });
    // Закрытие модалки
    document.querySelectorAll(".coaches__modal").forEach(function (modal) {
        modal.addEventListener("click", function (e) {
            if (e.target === modal) {
                modal.classList.remove("active");
            }
        });
    });
});
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!************************************!*\
  !*** ./dev/js/components/_main.js ***!
  \************************************/

})();


//# sourceMappingURL=main.bundle.js.map