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
          dots: true,
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


  var $containerInstafeed = $('#instafeed');
  // Instagram
  if ($('#instafeed').length) { 

    var feed = new Instafeed({
      get: 'user',
      userId: '248226773',
      clientId: '604a50aa8fab404f9705ed4b7dd7ad17',
      accessToken: '248226773.604a50a.403e75a180134bd9b810099ef51e38ef',
      limit: 7,
      resolution: 'standard_resolution',
      template: '<li class="instafeed__item" style="background-image: url({{image}});"><a href="{{link}}" target="_blank"><div class="instafeed__info"><span>{{likes}}</span><span>{{comments}}</span></div></a></li>',
      after: function () {
        if(checkWindowWidth() == 'desktop') {
          setTimeout(function () {
            $('#instafeed').isotope({
              masonry: {
                columnWidth: $containerInstafeed.width() / 5
              }
            });
          }, 500)
        }
      }
    });
    feed.run();
  };

  $(window).on('resize', function () {
    $containerInstafeed.isotope({
      // update columnWidth to a percentage of container width
      masonry: { columnWidth: ($containerInstafeed.width() < 480) ? $containerInstafeed.width() / 2 : $containerInstafeed.width() / 5 }
    });
  });

  // máscaras de formulário

  // Mascara de CPF e CNPJ
  var cpfCnpjMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length <= 11 ? '000.000.000-009' : '00.000.000/0000-00';
  },
    cpfCnpjpOptions = {
      onKeyPress: function (val, e, field, options) {
        field.mask(cpfCnpjMaskBehavior.apply({}, arguments), options);
      }
    };
  
  var phoneMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
  },
    options = {
      onKeyPress: function (val, e, field, options) {
        field.mask(phoneMaskBehavior.apply({}, arguments), options);
      }
    };

  $('.js-phone').mask(phoneMaskBehavior, options);
  $('.js-cpfcnpj').mask(cpfCnpjMaskBehavior, cpfCnpjpOptions);
  $('.js-ano').mask('0000');
  

  // form validate 
  var $formNewsletter = $("#formNewsletter");
  var $formConsignado = $("#formConsignado");

  $formNewsletter.validate({
    rules: {
      nome: {
        required: true,
        minlength: 3
      },
      email: {
        required: true,
        email: true
      }
    },
    errorClass: 'form__control--error',
    highlight: function (element, errorClass, validClass) {
      $(element).parent().addClass(errorClass)
    },
    errorPlacement: function (error, element) {
      return true;
    },
    submitHandler: function () {
      alert('sucesso');
      // lógica para sucesso do formulário
      /* var dados = $(form).serialize();

      $.ajax({
        type: "POST",
        url: "processa.php",
        data: dados,
        success: function (data) {
          alert(data);
        }
      });

      return false; */
    }
  });




  $formConsignado.validate({
    rules: {
      nome: {
        required: true,
        minlength: 3
      },
      email: {
        required: true,
        email: true
      },
      telefone: {
        required: true
      },
      cpfcnpj: {
        required: true
      },
      endereco: {
        required: true
      },
      marca: {
        required: true
      },
      modelo: {
        required: true
      },
      ano: {
        required: true
      },
      detalhes: {
        required: true
      }
    },
    errorClass: 'form__control--error',
    highlight: function (element, errorClass, validClass) {
      $(element).parent().addClass(errorClass)
    },
    errorPlacement: function (error, element) {
      return true;
    },
    submitHandler: function () {
      alert('sucesso');
      // lógica para sucesso do formulário
      /* var dados = $(form).serialize();

      $.ajax({
        type: "POST",
        url: "processa.php",
        data: dados,
        success: function (data) {
          alert(data);
        }
      });

      return false; */
    }
  });
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