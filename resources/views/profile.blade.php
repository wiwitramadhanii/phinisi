@extends('layout')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Perusahaan Pinisi Hakata</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <!-- AOS CSS -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

  <style>
    /* Container Padding */
    .py-5 { padding-top: 3rem !important; padding-bottom: 3rem !important; }

    /* Hero Section */
    .hero {
      position: relative;
      height: 60vh;
      background: url('{{ asset($company['banner']) }}') center/cover no-repeat;
      overflow: hidden;
    }
    .hero .overlay {
      position: absolute; top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.6);
    }
    .hero-content {
      position: relative;
      z-index: 2;
      color: #fff;
    }
    .hero-content .display-3 {
      font-size: 3.5rem;
      font-weight: 700;
    }
    .btn-outline-light {
      border-width: 2px;
      transition: background-color 0.3s;
    }
    .btn-outline-light:hover {
      background-color: rgba(255,255,255,0.2);
    }

    /* About Section */
    #about img {
      border-radius: 0.75rem;
      object-fit: cover;
    }

    /* Cards */
    .card {
      border-radius: 1rem;
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .card:hover {
      transform: translateY(-8px);
      box-shadow: 0 1rem 2rem rgba(0,0,0,0.2);
    }
    .card-body i {
      transition: transform 0.3s;
    }
    .card-body:hover i {
      transform: scale(1.1);
    }

    /* Core Values Hover */
    .values-card:hover {
      transform: translateY(-10px);
    }

    /* Contact Section */
    .btn-block {
      display: block;
      width: 100%;
      padding: 0.75rem;
      font-weight: 500;
    }

    /* AOS Overrides */
    [data-aos] { opacity: 0; transition-property: opacity, transform; }
    [data-aos].aos-animate { opacity: 1; }
  </style>
</head>
<body>

  <div class="container py-5">
    <!-- Hero -->
    <div class="hero mb-5">
      <div class="overlay"></div>
      <div class="hero-content d-flex flex-column justify-content-center align-items-start h-100 px-4" data-aos="fade-up">
        <img src="{{ asset($company['logo']) }}" alt="Logo {{ $company['name'] }}" class="mb-3" style="width: 120px;">
        <h1 class="display-3">{{ $company['name'] }}</h1>
        <p class="lead w-75 mt-3">{{ Str::limit($company['about'], 180) }}</p>
        <a href="#about" class="btn btn-lg btn-outline-light mt-4">Selengkapnya</a>
      </div>
    </div>

    <!-- About -->
    <section id="about" class="row align-items-center mb-5" data-aos="fade-right">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <img src="{{ asset('images/about-illustration.svg') }}" alt="About {{ $company['name'] }}" class="img-fluid shadow-sm">
      </div>
      <div class="col-lg-6" data-aos="fade-left">
        <h2 class="mb-4">Tentang Kami</h2>
        <p class="text-muted">{{ $company['about'] }}</p>
      </div>
    </section>

    <!-- Vision & Mission -->
    <div class="row mb-5">
      <div class="col-md-6" data-aos="zoom-in">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body text-center p-5">
            <i class="fas fa-eye fa-3x text-primary mb-3"></i>
            <h3 class="card-title mb-3">Visi</h3>
            <p class="card-text text-muted">{{ $company['vision'] }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body p-5">
            <i class="fas fa-bullseye fa-3x text-success mb-3 d-block text-center"></i>
            <h3 class="card-title mb-3 text-center">Misi</h3>
            <ul class="list-unstyled text-muted">
              @foreach ($company['mission'] as $m)
              <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>{{ $m }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Core Values -->
    <section class="mb-5" data-aos="fade-up">
      <h2 class="text-center mb-4">Nilai Inti</h2>
      <div class="row">
        @foreach ($company['values'] as $value)
        <div class="col-6 col-lg-3 mb-4" data-aos="flip-left">
          <div class="card values-card border-0 shadow-sm h-100 text-center py-5">
            <h5 class="card-title font-weight-bold">{{ $value }}</h5>
          </div>
        </div>
        @endforeach
      </div>
    </section>

    <!-- Contact -->
    <section class="mb-5" data-aos="fade-up">
      <h2 class="mb-4 text-center">Hubungi Kami</h2>
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card border-0 shadow-sm p-4">
            <p><i class="fas fa-map-marker-alt text-danger mr-2"></i>{{ $company['contact']['address'] }}</p>
            <p><i class="fas fa-phone-alt text-success mr-2"></i>{{ $company['contact']['phone'] }}</p>
            <p><i class="fas fa-envelope text-primary mr-2"></i>{{ $company['contact']['email'] }}</p>
            <a href="mailto:{{ $company['contact']['phone'] }}" class="btn btn-block btn-outline-success mt-3">Whatsapp</a>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({ duration: 800, once: true });
  </script>
</body>
</html>

@endsection
