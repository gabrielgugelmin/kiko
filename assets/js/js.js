$(function() {
  // Banner principal
  $('.js-banner-slider').slick();

  // Grid slider
  $('.js-grid-slider').slick({
    arrows: false,
    dots: true,
    slidesToShow: 3,
    slidesToScroll: 3
  });
});