$(document).ready(function () {
  var hotelSlider = new Swiper(".hotel-slider", {
    // Optional parameters
    loop: true,

    // Navigation arrows
    navigation: {
      nextEl: ".hotel-slider__button_next",
      prevEl: ".hotel-slider__button_prev",
    },

    // Управление с клавиатуры
    keyboard: {
      enabled: true,
    },
  });
  var reviewsSlider = new Swiper(".reviews-slider", {
    // Optional parameters
    loop: true,

    // Navigation arrows
    navigation: {
      nextEl: ".reviews-slider__button_next",
      prevEl: ".reviews-slider__button_prev",
    },

    // Управление с клавиатуры
    keyboard: {
      enabled: true,
    },
  });
  $(".parallax-window").parallax({ imageSrc: "./img/newsletter-bg.jpg" });

  var menuButton = $(".menu-button");
  menuButton.on("click", function () {
    //console.log("Клик по кнопке меню");
    $(".navbar-bottom").toggleClass("navbar-bottom_visible");
  });

  var modalButton = $("[data-toggle=modal]");
  var closeModalButton = $(".modal__close");
  // Вывод данных переменной в консоль
  //console.log(modalButton);
  modalButton.on("click", openModal);
  closeModalButton.on("click", closeModal);

  $(document).on("keydown", function (event) {
    if (event.keyCode == 27) closeModal(event);
  });

  function openModal() {
    var targetModal = $(this).attr("data-href");
    console.log(targetModal);
    $(targetModal).find(".modal__overlay").addClass("modal__overlay--visible");
    $(targetModal).find(".modal__dialog").addClass("modal__dialog--visible");
  }

  function closeModal(event) {
    event.preventDefault();
    var modalOverlay = $(".modal__overlay");
    var modalDialog = $(".modal__dialog");
    modalOverlay.removeClass("modal__overlay--visible");
    modalDialog.removeClass("modal__dialog--visible");
  }

  // Обработка форм
  $(".form").each(function () {
    $(this).validate({
      errorClass: "invalid",
      rules: {
        phone: {
          required: true,
          minlength: 18,
          // number: true,
        },
      },
      messages: {
        name: {
          required: "Please specify your full name",
          minlength: "The name must be at least 2 letters long",
        },
        phone: {
          required: "Please enter your phone number",
          minlength: "Invalid phone number",
        },
        email: {
          required: "Please enter your email address",
          email: "Email must be in the format name@domain.com",
        },
      },
    });
  });

  //Маска для номера телефона jQuery Mask Input
  $(".phone").mask("+7 (000) 000-00-00");

  //Initialize AOS
  AOS.init();

  //Загрузка карты по наведению
  $(".google-map").hover(function () {
    $(this).attr(
      "src",
      'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.004681430924!2d79.80141631528154!3d7.5744669945377785!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2c96110de8289%3A0x3fd7668bc2d85eb9!2sGrand%20Hilton%20Hotel!5e0!3m2!1sru!2sru!4v1595368124164!5m2!1sru!2sru"'
    );
  });

  //Загрузка изображений после загрузки страницы
  function init() {
    var imgDefer = document.getElementsByTagName("img");
    for (var i = 0; i < imgDefer.length; i++) {
      if (imgDefer[i].getAttribute("data-src")) {
        imgDefer[i].setAttribute("src", imgDefer[i].getAttribute("data-src"));
      }
    }
  }
  window.onload = init;
});
