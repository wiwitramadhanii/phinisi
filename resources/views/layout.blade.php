<!DOCTYPE html>
<html class="no-js" lang="zxx">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Phinisi</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png" />
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/themify-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/flaticon.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/gijgo.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/slicknav.css') }}" />
    <link
      rel="stylesheet"
      href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />

    <script src="{{ asset('frontend/js/calendar.js') }}"defer></script>
    
  </head>

  <body>

    <!-- header-start -->
    <header>
      <div class="header-area">
        <div id="sticky-header" class="main-header-area">
          <div class="container-fluid">
            <div class="header_bottom_border">
              <div class="row align-items-center">
                <div class="col-xl-2 col-lg-2">
                  <div class="logo">
                    <a href="{{ route('home') }}">
                      <img src="{{ asset('frontend/img/phinisi/logo-header.png') }}" alt="" />
                    </a>
                  </div>
                </div>
                <div class="col-xl-8 col-lg-8">
                  <div class="main-menu d-none d-lg-block">
                    <nav>
                      <ul id="navigation">
                        <li>
                          <a href="{{ route('home') }}">home</a>
                        </li>
                        <li>
                          <a href="{{ route('home') }}">Profile</a>
                        </li>
                        <li>
                          <a href="{{ route('package') }}">Package</a>
                        </li>
                        <li>
                          <a href="{{ route('home') }}">Event</a>
                        </li>
                      </ul>
                    </nav>
                  </div>
                </div>
                <div class="col-12">
                  <div class="mobile_menu d-block d-lg-none"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- header-end -->

    @yield('content')

    <footer class="footer">
      <div class="footer_top">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-md-6 col-lg-4">
              <div class="footer_widget">
                <div class="footer_logo">
                  <a href="#">
                    <img src="{{ asset('frontend/img/phinisi/logo-footer.png') }}" alt="" />
                  </a>
                </div>
                <p>
                  Pantai Losari
                </p>
                {{-- <div class="socail_links">
                  <ul>
                    <li>
                      <a href="#">
                        <i class="ti-facebook"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="fa fa-instagram"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="fa fa-youtube-play"></i>
                      </a>
                    </li>
                  </ul>
                </div> --}}
              </div>
            </div>
            {{-- <div class="col-xl-2 col-md-6 col-lg-2">
              <div class="footer_widget">
                <h3 class="footer_title">Company</h3>
                <ul class="links">
                  <li><a href="#">Pricing</a></li>
                  <li><a href="#">About</a></li>
                  <li><a href="#"> Gallery</a></li>
                  <li><a href="#"> Contact</a></li>
                </ul>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 col-lg-3">
              <div class="footer_widget">
                <h3 class="footer_title">Popular destination</h3>
                <ul class="links double_links">
                  <li><a href="#">Indonesia</a></li>
                  <li><a href="#">America</a></li>
                  <li><a href="#">India</a></li>
                  <li><a href="#">Switzerland</a></li>
                  <li><a href="#">Italy</a></li>
                  <li><a href="#">Canada</a></li>
                  <li><a href="#">Franch</a></li>
                  <li><a href="#">England</a></li>
                </ul>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 col-lg-3">
              <div class="footer_widget">
                <h3 class="footer_title">Instagram</h3>
                <div class="instagram_feed">
                  <div class="single_insta">
                    <a href="#">
                      <img src="img/instagram/1.png" alt="" />
                    </a>
                  </div>
                  <div class="single_insta">
                    <a href="#">
                      <img src="img/instagram/2.png" alt="" />
                    </a>
                  </div>
                  <div class="single_insta">
                    <a href="#">
                      <img src="img/instagram/3.png" alt="" />
                    </a>
                  </div>
                  <div class="single_insta">
                    <a href="#">
                      <img src="img/instagram/4.png" alt="" />
                    </a>
                  </div>
                  <div class="single_insta">
                    <a href="#">
                      <img src="img/instagram/5.png" alt="" />
                    </a>
                  </div>
                  <div class="single_insta">
                    <a href="#">
                      <img src="img/instagram/6.png" alt="" />
                    </a>
                  </div>
                </div>
              </div>
            </div> --}}
          </div>
        </div>
      </div>
    </footer>

    <!-- Modal -->
    <div
      class="modal fade custom_search_pop"
      id="exampleModalCenter"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="serch_form">
            <input type="text" placeholder="Search" />
            <button type="submit">search</button>
          </div>
        </div>
      </div>
    </div>
    <!-- link that opens popup -->
    <!--     
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-de7e2ef6bfefd24b79a3f68b414b87b8db5b08439cac3f1012092b2290c719cd.js"></script>

    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"> </script> -->
    <!-- JS here -->

    <script src="{{ asset('frontend/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/js/ajax-form.js') }}"></script>
    <script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/js/scrollIt.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/js/nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.slicknav.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/plugins.js') }}"></script>
    <script src="{{ asset('frontend/js/gijgo.min.js') }}"></script>
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>

    <!--contact js-->
    <script src="{{ asset('frontend/js/contact.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.form.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('frontend/js/mail-script.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script>
      $('#datepicker').datepicker({
        iconsLibrary: 'fontawesome',
        icons: {
          rightIcon: '<span class="fa fa-caret-down"></span>',
        },
      });
    </script>
  </body>
</html>
