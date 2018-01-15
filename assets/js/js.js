$(function() {
  // Ajusta header-top
  if (checkWindowWidth() == 'mobile') {
    $('.header-top').detach().appendTo('.header-bottom');
  }

  $(window).on('resize', function () {
    if (checkWindowWidth() == 'mobile') {
      $('.header-top').detach().appendTo('.header-bottom');
    } else {
      $('.header-top').detach().prependTo('.header');
    }
  });

  // Banner principal
  $('.js-banner-slider').slick({
    arrows: false
  });

  // Grid slider
  $('.js-grid-slider').slick({
    arrows: true,
    dots: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    mobileFirst: true,
    responsive: [
      {
        breakpoint: 480,
        settings: {
          dots: true,
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 767,
        settings: {
          arrows: false,
          slidesToShow: 3,
          slidesToScroll: 3,
        }
      }
    ]
  });

  // MENU
  // click no hamburguer icon
  $('.hamburger').on('click', function (e) {
    e.preventDefault();

    if ($('.header').hasClass('header--open')) {
      closeMenu();
    } else {
      openMenu();
    }
  });

  // Instagram
  if ($('#instafeed').length) {

    var feed = new Instafeed({
      get: 'user',
      userId: '4167153856',
      clientId: '9dd32bbb00284a19b83ebe8dbda91cb6',
      accessToken: '4167153856.1677ed0.7cfe7712070d4c5da39d9a197a0f4d9a',
      limit: 10,
      template: '<li class="instafeed__item" style="background-image: url({{image}});"><a href="{{link}}" target="_blank"></a></li>'
    });
    feed.run();
  }
});

function closeMenu() {
  $('.header').removeClass('header--open');
  $('.hamburger').removeClass('is-open');
  $('body').removeClass('overflowHidden');
}

function openMenu() {
  $('.hamburger').addClass('is-open');
  $('.header').addClass('header--open');
  $('body').addClass('overflowHidden');
}

function viewport() {
  var e = window, a = 'inner';
  if (!('innerWidth' in window)) {
    a = 'client';
    e = document.documentElement || document.body;
  }
  return { width: e[a + 'Width'], height: e[a + 'Height'] };
}

function checkWindowWidth() {
  var w = viewport().width;
  var size = '';
  if (w > 991) {
    size = 'desktop';
  } else {
    size = 'mobile';
  }

  return size;
}