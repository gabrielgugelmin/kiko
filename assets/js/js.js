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

  // Veiculo slider
  $('.js-slider-veiculo').slick({
    arrows: true,
    asNavFor: $('.js-slider-veiculo-nav'),
    cssEase: 'linear',
    dots: true,
    slidesToScroll: 1,
    slidesToShow: 1
  });

  $('.js-slider-veiculo-nav').slick({
    arrows: true,
    asNavFor: $('.js-slider-veiculo'),
    cssEase: 'linear',
    dots: false,
    focusOnSelect: true,
    slidesToScroll: 1,
    slidesToShow: 3,
    mobileFirst: true,
    responsive: [
      {
        breakpoint: 540,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1
        }
      }
    ]
  });

  $('.js-slider-sobre').slick({
    dots: true,
    arrows: false,
    autoplay: true
  });
  
  $('.js-slider-historia').slick({
    dots: true,
    arrows: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    mobileFirst: true,
    responsive: [
      {
        breakpoint: 767,
        settings: {
          
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 992,
        settings: {
          arrows: true,
          dots: false,
          slidesToShow: 4,
          slidesToScroll: 1
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

  $.validator.addMethod(
    "validateData",
    function (value, element) {
      return this.optional(element) || /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/.test(value);
    }
  );

  $('.js-phone').mask(phoneMaskBehavior, options);
  $('.js-cpfcnpj').mask(cpfCnpjMaskBehavior, cpfCnpjpOptions);
  $('.js-ano').mask('0000');
  $('.js-date').mask('00/00/0000');
  

  // form validate 
  var $formNewsletter = $("#formNewsletter");
  var $formConsignado = $("#formConsignado");
  var $formFinanciamento = $("#formFinanciamento");
  var $formContato = $("#formContato");
  var $formProposta = $("#formProposta");

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
    unhighlight: function (element, errorClass, validClass) {
      $(element).parent().removeClass('error');
    },
    errorPlacement: function (error, element) {
      return true;
    },
    submitHandler: function () {
      alert('sucesso');
      form.submit();
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
    unhighlight: function (element, errorClass, validClass) {
      $(element).parent().removeClass('error');
    },
    errorPlacement: function (error, element) {
      return true;
    },
    submitHandler: function () {
      alert('sucesso');
      form.submit();
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

  $formFinanciamento.validate({
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
      qtd_parcelas: {
        required: true
      },
      cpfcnpj: {
        required: true
      },
      data_nascimento: {
        required: true,
        validateData: true
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
    unhighlight: function (element, errorClass, validClass) {
      $(element).parent().removeClass('error');
    },
    errorPlacement: function (error, element) {
      return true;
    },
    submitHandler: function () {
      alert('sucesso');
      form.submit();
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

  $formContato.validate({
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
      assunto: {
        required: true
      },
      mensagem: {
        required: true
      }
    },
    errorClass: 'form__control--error',
    highlight: function (element, errorClass, validClass) {
      $(element).parent().addClass(errorClass)
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).parent().removeClass('error');
    },
    errorPlacement: function (error, element) {
      return true;
    },
    submitHandler: function () {
      alert('sucesso');
      form.submit();
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

  $formProposta.validate({
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
      formas_pagamento: {
        required: true
      },
      mensagem: {
        required: true
      }
    },
    errorClass: 'form__control--error',
    highlight: function (element, errorClass, validClass) {
      $(element).parent().addClass(errorClass)
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).parent().removeClass('error');
    },
    errorPlacement: function (error, element) {
      return true;
    },
    submitHandler: function () {
      alert('sucesso');
      form.submit();
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




  // Grid

  if ($('.js-grid').length) {
    getProducts();
  }
});

var qsRegex;
var marcaFilter;
var modeloFilter;

function initIsotope() {
  // GRID
  // init Isotope
  var $container = $('.js-grid').isotope({
    itemSelector: '.grid__item',
    layoutMode: 'fitRows',
    getSortData: {
      valor: '[data-valor] parseInt',
      ano: '[data-ano]',
      modelo: '[data-modelo]'
    },
    filter: function () {
      var $this = $(this);
      var searchResult = qsRegex ? $this.text().match(qsRegex) : true;
      var marcaResult = marcaFilter ? $this.is(marcaFilter) : true;
      var modeloResult = modeloFilter ? $this.is(modeloFilter) : true;
      return searchResult && marcaResult && modeloResult;
    }
  });

  var initShow = 12; //number of items loaded on init & onclick load more button
  var counter = initShow; //counter for load more button
  var iso = $container.data('isotope'); // get Isotope instance
  var footer = $('.grid__footer .container');

  if ($container.is('#Container')) {
    //append load more button
    footer.append('<button class="button button--red button--ghost button--icon button--medium js-load-more">CARREGAR MAIS<svg version="1.1" id="Capa_1" xmlns=http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve"><g><g id="plus"><polygon points="32,12 20,12 20,0 12,0 12,12 0,12 0,20 12,20 12,32 20,32 20,20 32,20"/></g></g></svg></button >');
  }


  loadMore(initShow); //execute function onload

  function loadMore(toShow) {
    var elems = $container.isotope('getFilteredItemElements');

    $container.find(".hidden").removeClass("hidden");

    var hiddenElems = iso.filteredItems.slice(toShow, elems.length).map(function (item) {
      return item.element;
    });

    $(hiddenElems).addClass('hidden');
    $container.isotope('layout');

    //when no more to load, hide show more button
    if (hiddenElems.length == 0 && $container.is('#Container')) {
      jQuery(".js-load-more").hide();
      footer.append('<a href="contato.html" id="entreContato" class="button button--red button--ghost button--medium">entre em contato</a>');
    } else {
      jQuery("#entreContato").show();
      jQuery(".js-load-more").show();
    };

    $('.js-load-more').removeClass('is-loading');

  }




  //when load more button clicked
  $(".js-load-more").click(function () {
    $(this).addClass('is-loading');

    if ($('.js-filter button').data('clicked')) {
      //when filter button clicked, set initial value for counter
      counter = initShow;
      $('.js-filter button').data('clicked', false);
    } else {
      counter = counter;
    };

    counter = counter + initShow;

    loadMore(counter);
  });

  // bind sort button click
  $('.filtro-veiculo').on('click', 'a', function () {
    var sortByValue = $(this).attr('data-sort-by');
    $container.isotope({ sortBy: sortByValue });
  });

  // change is-active class on buttons
  $('.filtro__item').each(function (i, buttonGroup) {
    $(this).on('click', function () {
      $('.filtro__item').not(this).removeClass('is-active');
      $(this).addClass('is-active');

      var categoria = $(this).attr('data-filter');
      
      $container.isotope({
        filter: categoria
      });
    });
  });

  $('#ordem').on('change', function () {
    var filterValue = this.value;
    
    $container.isotope({
      sortBy: filterValue,
      sortAscending: true
    });
  });
  
  $('#marca').on('change', function () {
    marcaFilter = this.value;

    $container.isotope();
  });

  $('#modelo').on('change', function () {
    modeloFilter = this.value;

    $container.isotope();
  });

  // use value of search field to filter
  var $quicksearch = $('.quicksearch').keyup(debounce(function () {
    qsRegex = new RegExp($quicksearch.val(), 'gi');
    $container.isotope();
  }, 200));

  // debounce so filtering doesn't happen every millisecond
  function debounce(fn, threshold) {
    var timeout;
    return function debounced() {
      if (timeout) {
        clearTimeout(timeout);
      }
      function delayed() {
        fn();
        timeout = null;
      }
      timeout = setTimeout(delayed, threshold || 100);
    }
  }

}

function getProducts() {

  var query_string = {};
  var query = window.location.search.substring(1);
  var vars = query.split("&");
  for (var i = 0; i < vars.length; i++) {
    var pair = vars[i].split("=");
    // If first entry with this name
    if (typeof query_string[pair[0]] === "undefined") {
      query_string[pair[0]] = decodeURIComponent(pair[1]);
      // If second entry with this name
    } else if (typeof query_string[pair[0]] === "string") {
      var arr = [query_string[pair[0]], decodeURIComponent(pair[1])];
      query_string[pair[0]] = arr;
      // If third or later entry with this name
    } else {
      query_string[pair[0]].push(decodeURIComponent(pair[1]));
    }
  }

  //Veriavel com categoria
  var idCategoria = query_string.categoria;

  $.getJSON("http://kikoautos.com.br/front/assets/json/veiculos.json", function (data) {

  })
    .fail(function (data) {
      console.log("error");
    }).success(function (data) {
      $elementos = [];

      var x = false;
      $.each(data, function (index, element) {
        if (element.titulo != '') {
          var blindado = (element.blindado) ? 'grid__item--blindado' : '';
          var seminovo = (element.seminovo) ? 'grid__item--seminovo' : '';
          var novo = (element.novo) ? 'grid__item--novo' : '';

          var $box = '<a href="#!" class="grid__item ' + blindado + ' ' + seminovo + ' ' + novo + ' ' + element.marca + ' ' + element.modelo +'" data-valor="' + element.valor + '" data-ano="'+ element.ano +'">' +
            '<div class="grid__img" style="background-image:url(assets/img/carros/c1.jpg)"></div>' +
            '<div class="grid__desc">' +
              '<h3>' + element.name + '</h3>' +
              '<p>' + element.desc + '</p>' +
              '<div class="grid__price">R$ ' + element.valor + '</div>' +
            '</div>' +
          '</a>';

        } else {

          var $box = '<h3>Nada por aqui. <a href="./">Clique para voltar.</a></h3><br>';
        }

        $(".js-grid").append($box);

      });

      if (x == true) {
      } else {
        initIsotope();
      }

    });
}

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