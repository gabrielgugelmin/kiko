$(function() {
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