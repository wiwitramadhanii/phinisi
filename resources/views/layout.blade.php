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
    <div id="preloader">
      <div class="dots">
        <span class="dot dot1"></span>
        <span class="dot dot2"></span>
        <span class="dot dot3"></span>
      </div>
    </div>
  

    <!-- header-start -->
    <header>
      <div class="header-area">
        <div id="sticky-header" class="main-header-area">
          <div class="container">
            <div class="header-bottom">
              <div class="row align-items-center">
                <div class="col-logo">
                  <div class="logo">
                    <a href="{{ route('home') }}">
                      <img src="{{ asset('frontend/img/phinisi/logo-header.png') }}" alt="Logo Pinisi Hakata" />
                    </a>
                  </div>
                </div>
                <div class="col-nav">
                  <nav class="main-menu d-none d-lg-block">
                    <ul id="navigation">
                      <li><a href="{{ route('home') }}">Home</a></li>
                      <li><a href="{{ route('profile') }}">Profile</a></li>
                      <li><a href="{{ route('package') }}">Package</a></li>
                      <li><a href="{{ route('home') }}">Event</a></li>
                    </ul>
                  </nav>
                </div>
                <div class="col-toggle d-block d-lg-none">
                  <button class="mobile-toggle"><span></span><span></span><span></span></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    
    <!-- header-end -->

    @yield('content')

    <footer class="footer bg-navy text-light pt-5">
      <div class="footer_top pb-4">
        <div class="container">
          <div class="row gy-4">
    
            <!-- Logo & Deskripsi -->
            <div class="col-md-4">
              <div class="footer_widget">
                <a href="#" class="d-inline-block mb-3">
                  <img src="{{ asset('frontend/img/phinisi/logo-footer.png') }}"
                       alt="Logo Pinisi Hakata"
                       class="img-fluid"
                       style="max-height: 60px;" />
                </a>
                <p class="small">
                  Pantai Losari – Destinasi wisata ikonik di Makassar dengan sunset terbaik.
                </p>
                <div class="social_links mt-3">
                  <a href="#" class="social-icon"><i class="ti-facebook"></i></a>
                  <a href="#" class="social-icon"><i class="fa fa-instagram"></i></a>
                  <a href="#" class="social-icon"><i class="fa fa-youtube-play"></i></a>
                </div>
              </div>
            </div>
    
            <!-- Quick Links -->
            <div class="col-md-2 border-start border-secondary ps-md-4">
              <div class="footer_widget">
                <h5 class="footer_title mb-3">Perusahaan</h5>
                <ul class="list-unstyled links">
                  <li><a href="{{ route('profile') }}">Tentang Kami</a></li>
                  <li><a href="{{ route('package') }}">Layanan</a></li>
                </ul>
              </div>
            </div>
    
            <!-- Destinasi Populer -->
            <div class="col-md-3 border-start border-secondary ps-md-4">
              <div class="footer_widget">
                <h5 class="footer_title mb-3">Packages</h5>
                <ul class="list-unstyled links double_links">
                  <li><a href="{{ route('package') }}">Golden Hours Cruise</a></li>
                  <li><a href="{{ route('package') }}">Morning Samalona</a></li>
                  <li><a href="{{ route('package') }}">Full Day Kodingareng</a></li>
                </ul>
              </div>
            </div>
    
            <!-- Kontak & Newsletter -->
            <div class="col-md-3 border-start border-secondary ps-md-4">
              <div class="footer_widget">
                <h5 class="footer_title mb-3">Newsletter</h5>
                <form class="d-flex mb-4">
                  <input type="email"
                         class="form-control form-control-sm me-2"
                         placeholder="Email Anda" />
                  <button type="submit" class="btn btn-sm btn-light">Daftar</button>
                </form>
                <div class="contact">
                  <p class="small mb-2"><i class="fa fa-map-marker-alt me-2"></i>Jl. Pantai Losari No.1, Makassar</p>
                  <p class="small mb-2"><i class="fa fa-phone me-2"></i>+62 812 3456 7890</p>
                  <p class="small"><i class="fa fa-envelope me-2"></i>info@pinisihakata.co.id</p>
                </div>
              </div>
            </div>
    
          </div> <!-- /.row -->
    
          <hr class="border-secondary my-4" />
    
          <div class="row">
            <div class="col text-center">
              <p class="small mb-0">&copy; 2025 Pinisi Hakata. All rights reserved.</p>
            </div>
          </div>
        </div> <!-- /.container -->
      </div> <!-- /.footer_top -->
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
    <script>
      window.addEventListener('load', function() {
        const preloader = document.getElementById('preloader');
        // tambahkan class .hide untuk transisi fade‑out
        preloader.classList.add('hide');
        
        // (opsional) benar-benar remove dari DOM setelah transisi selesai
        setTimeout(() => {
          if (preloader.parentNode) {
            preloader.parentNode.removeChild(preloader);
          }
        }, 600); // delay sedikit lebih panjang dari durasi transition
      });
    </script>
    

  
  </body>
</html>