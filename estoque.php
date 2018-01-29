<?php header('Access-Control-Allow-Origin: *'); ?>
<html>

<head>
  <meta charset="UTF-8">
  <title>Kiko Autos</title>

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- CSS -->

  <link rel="stylesheet" href="assets/css/normalize.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="assets/css/slick.css">
  <link rel="stylesheet" href="assets/css/slick-theme.css">
  <link rel="stylesheet" href="assets/css/perfect-scrollbar.css">

  <link rel="stylesheet" href="assets/css/style.css">

  <!-- FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">

  <!-- FACEBOOK -->
  <meta property="og:url" content="" />
  <meta property="og:type" content="" />
  <meta property="og:title" content="" />
  <meta property="og:description" content="" />
  <meta property="og:image" content="" />

</head>

<body>

  <div class="page-wrapper">
    <header class="header">
      <div class="header-aux">
        <div class="hamburger">
          <div class="hamburger-box">
          </div>
        </div>

        <a href="index.html" class="header-aux__logo">
          <img src="assets/img/logo.png" alt="Kiko Autos">
        </a>
      </div>

      <div class="header-top">
        <div class="container">
          <div class="header-top__content">
            <small class="header__slogan">KIKOAUTOS - Multimarcas . Multipossibilidades.</small>

            <div class="social">
              <ul class="social__list">
                <li class="social__item">
                  <a href="#!">
                    <img src="assets/img/icons/facebook.svg" alt="Facebook">
                  </a>
                </li>
                <li class="social__item">
                  <a href="#!">
                    <img src="assets/img/icons/instagram.svg" alt="Instagram">
                  </a>
                </li>
                <li class="social__item">
                  <a href="#!">
                    <img src="assets/img/icons/whatsapp.svg" alt="WhatsApp">
                  </a>
                </li>
                <li>
                  <div class="icon-text">
                    <img src="assets/img/icons/phone.svg" alt="Telefone">
                    <p>+55 12 3632 3200</p>
                  </div>
                </li>
              </ul>
            </div>

          </div>
        </div>
      </div>

      <div class="header-bottom">
        <div class="header-bottom__content">
          <a href="index.html" class="header__logo">
            <img src="assets/img/logo.png" alt="Kiko Autos">
          </a>

          <nav class="menu">
            <ul class="menu__list">
              <li class="menu__item">
                <a href="sobre.html" class="menu__link">Sobre</a>
              </li>
              <li class="menu__item">
                <a href="estoque.php" class="menu__link">Novos</a>
              </li>
              <li class="menu__item">
                <a href="estoque.php" class="menu__link">Seminovos</a>
              </li>
              <li class="menu__item">
                <a href="financiamento.html" class="menu__link">Financiamento</a>
              </li>
              <li class="menu__item">
                <a href="consorcio.html" class="menu__link">Consórcio</a>
              </li>
              <li class="menu__item">
                <a href="contato.html" class="menu__link">Contato</a>
              </li>
              <li class="menu__item">
                <div class="search">
                  <button class="search__button js-toggle-search">
                    <img src="assets/img/icons/search.svg" alt="Buscar">
                  </button>
                  
                  <div class="search__content">
                    <input type="text" name="input_busca" value="" placeholder="Buscar veículo..." class="js-search">
                    
                    <div class="search__result"></div>
                  </div>
                </div>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </header>

    <div class="page-content">
      <div class="section section--no-padding filtro js-filter">
        <button class="filtro__item filtro__item--green" data-filter=".grid__item--seminovo">
          <h3>SEMINOVOS</h3>
          <img src="assets/img/seminovos.png" alt="Seminovos">
        </button>
        <button class="filtro__item filtro__item--red" data-filter=".grid__item--novo">
          <h3>NOVOS</h3>
          <img src="assets/img/novos.png" alt="Novo">
        </button>
        <button class="filtro__item filtro__item--blue" data-filter=".grid__item--blindado">
          <h3>BLINDADOS</h3>
          <img src="assets/img/blindados.png" alt="Blindado">
        </button>
      </div>

      <section class="section section--white">
        <div class="section__header">
          <div class="container">
            <h2>ESTOQUE</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ac tortor at tellus feugiat congue quis ut nunc. Semper ac
              dolor vitae accumsan.</p>
          </div>
        </div>
        <div class="section__content section--padding-bottom">
          <div class="container">
            <div class="form form--inline">
              <div class="form__control">
                <input class="input quicksearch" type="search" placeholder="FILTRAR POR TERMOS">
              </div>
              <div class="form__control form__control--select">
                <select class="select" name="marca" id="marca">
                  <option value="0" disabled selected>FILTRAR POR MARCA</option>
                  <option value="*">TODOS</option>
                  <option value=".audi">AUDI</option>
                  <option value=".bmw">BWM</option>
                  <option value=".mercedes">MERCEDES</option>
                </select>
              </div>
              <div class="form__control form__control--select">
                <select class="select" name="modelo" id="modelo">
                  <option value="0" disabled selected>FILTRAR POR MODELO</option>
                  <option value="*">TODOS</option>
                  <option value=".modelo1">MODELO 1</option>
                  <option value=".modelo2">MODELO 2</option>
                  <option value=".modelo3">MODELO 3</option>
                </select>
              </div>
              <div class="form__control form__control--select">
                <select class="select" name="ordem" id="ordem">
                  <option value="0" disabled selected>ORDENAR POR</option>
                  <option value="*">TODOS</option>
                  <option value="valor">VALOR</option>
                  <option value="ano">ANO</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="grid section section--no-padding section--white">
        <div class="section__grid">

          <div class="grid js-grid" id="Container">

          </div>
        </div>

        <footer class="grid__footer">
          <div class="container">
          </div>
        </footer>


      </section>

      <section class="section section--white section--padding-bottom">
        <header class="section__header">
          <div class="container">
            <div class="col-md-8 col-md-offset-2">
              <h2>SERVIÇOS</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
          </div>
        </header>
      </section>

      <section>
        <div class="media media--horizontal media--full">
          <a href="financiamento.html" class="media__item">
            <div class="media__img" style="background-image: url(assets/img/p1.jpg);"></div>
            <div class="media__desc media__desc--gray">
              <h4 class="media__title">FINANCIAMENTO</h4>
            </div>
          </a>

          <a href="consorcio.html" class="media__item">
            <div class="media__img" style="background-image: url(assets/img/p2.jpg);"></div>
            <div class="media__desc media__desc--red">
              <h4 class="media__title">CONSÓRCIO</h4>
            </div>
          </a>



        </div>
      </section>

      <section class="section newsletter">
        <header class="section__header">
          <div class="container">
            <div class="col-md-8 col-md-offset-2">
              <h2>ASSINE NOSSO NEWSLETTER</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ac tortor at tellus feugiat congue quis ut
                nunc. Semper ac dolor vitae accumsan. interdum hendrerit lacinia.</p>
            </div>
          </div>
        </header>

        <div class="k-container">
          <div class="section__content">
            <form class="form form--inline" id="formNewsletter">
              <div class="form__control">
                <input type="text" class="input" placeholder="NOME COMPLETO" name="nome">
                <span class="form__error">*</span>
              </div>

              <div class="form__control">
                <input type="email" class="input" placeholder="E-MAIL" name="email">
                <span class="form__error">*</span>
              </div>

              <div class="form__control">
                <button type="submit" class="button button--arrow button--large">cadastrar</button>
              </div>
            </form>

            <small class="newsletter__small">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum
              dolor sit amet, consectetur adipiscing elit.
            </small>
          </div>
        </div>
      </section>

      <section class="section section--white">
        <header class="section__header">
          <div class="container">
            <div class="col-md-8 col-md-offset-2">
              <h2>KIKOAUTOS NO INSTAGRAM</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ac tortor at tellus feugiat congue quis ut
                nunc. Semper ac dolor vitae accumsan. interdum hendrerit lacinia.</p>
            </div>
          </div>
        </header>

        <div class="section__content">
          <div id="instafeed" class="instafeed"></div>
        </div>

        <a hreft="https://www.instagram.com/kikoautos" class="instafeed__link" target="_blank">
          https://www.instagram.com/kikoautos
        </a>
      </section>
    </div>


    <footer class="footer">
      <div class="container">

        <div class="row">
          <div class="col-md-4">
            <img src="assets/img/logo-footer.png" alt="Kiko Autos" class="footer__logo">
            <small class="footer__about">
              A KikoAutos tem como foco oferecer a seus clientes serviços agregados, não apenas um excelente automóvel 0KM ou seminovo.
              Por isso, serve como vitrine para o mercado e se destaca pelo seu atendimento de qualidade, consultores altamente
              treinados e infraestrutura moderna e diferenciada.
            </small>

            <div class="social social--big">
              <ul class="social__list">
                <li class="social__item">
                  <a href="#!">
                    <img src="assets/img/icons/facebook.svg" alt="Facebook">
                  </a>
                </li>
                <li class="social__item">
                  <a href="#!">
                    <img src="assets/img/icons/instagram.svg" alt="Instagram">
                  </a>
                </li>
                <li class="social__item">
                  <a href="#!">
                    <img src="assets/img/icons/whatsapp.svg" alt="WhatsApp">
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-2">
            <h5 class="footer__title">LINKS</h5>

            <ul class="footer__list">
              <li>
                <a href="sobre.html">Sobre</a>
              </li>
              <li>
                <a href="estoque.php">Novos</a>
              </li>
              <li>
                <a href="estoque.php">Seminovos</a>
              </li>
              <li>
                <a href="financiamento.html">Financiamento</a>
              </li>
              <li>
                <a href="consorcio.html">Consórcio</a>
              </li>
              <li>
                <a href="contato">Contato</a>
              </li>
            </ul>
          </div>
          <div class="col-md-3">
            <h5 class="footer__title">CONTATO</h5>

            <address class="footer__address">
              <div class="footer__contact icon-text">
                <img src="assets/img/icons/pin.svg" alt="Local">
                <p>Rua Dr. Emilio Winther, 68.
                  <br>Centro Taubaté / SP</p>
              </div>
              <div class="footer__contact icon-text">
                <img src="assets/img/icons/clock.svg" alt="Horário">
                <p>Segunda à sexta das 9h às 18h30 Sábado das 9h às 13h</p>
              </div>

              <div class="footer__contact footer__contact--big icon-text">
                <img src="assets/img/icons/phone.svg" alt="Horário">
                <p>12 3632 3200</p>
              </div>
            </address>
          </div>

          <div class="col-md-3">
            <h5 class="footer__title">CONTATO</h5>

            <address class="footer__address">
              <div class="footer__contact icon-text">
                <img src="assets/img/icons/pin.svg" alt="Local">
                <p>Rua Dr. Emilio Winther, 68.
                  <br>Centro Taubaté / SP</p>
              </div>
              <div class="footer__contact icon-text">
                <img src="assets/img/icons/clock.svg" alt="Horário">
                <p>Segunda à sexta das 9h às 18h30 Sábado das 9h às 13h</p>
              </div>

              <div class="footer__contact footer__contact--big icon-text">
                <img src="assets/img/icons/phone.svg" alt="Horário">
                <p>12 3632 3200</p>
              </div>
            </address>
          </div>
        </div>
      </div>
      <!-- container -->

      <div class="footer__bottom">
        <div class="container">
          <small>
            Todos os direitos reservados
            <span>Kiko Autos Automóveis 2017.</span>
          </small>

          <div class="powered-by-inffus">
            <a title="Desenvolvido pela Inffus" href="http://inffus.com" target="_blank">
              <img src="http://inffus.com/inffus-web-intelligence.svg" width="20">
            </a>

          </div>
        </div>
      </div>
    </footer>
    <!-- footer -->
  </div>
  <!-- PageWrapper -->

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVQh8KHCVUKoqVJHQGZbQNHdYjAPe8Km0"></script>

  <script src="assets/js/jquery.min.js"></script>
  <!--   <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/isotope.pkgd.min.js"></script>
  <script src="assets/js/jquery.autocomplete.min.js"></script>
  <script src="assets/js/jquery.fancybox.min.js"></script>
  <script src="assets/js/perfect-scrollbar.jquery.min.js"></script>
  <script src="assets/js/slick.min.js"></script>
  <script src="assets/js/instafeed.min.js"></script> -->
  <script src="assets/js/js.min.js"></script>



</body>

</html>