@extends('layout')

@section('content')

<!-- slider_area_start -->
<div class="slider_area">
    <div class="slider_active owl-carousel">
    @foreach ($sliders as $slider)
      <div
      style="background-image: url({{ asset('storage/' . $slider->image) }})" width="100"
      class="single_slider d-flex align-items-center overlay">
     </div>
    @endforeach
    </div>
</div>
<!-- slider_area_end -->

<!-- itinerary -->
<div class="itinerary_area">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 text-center mb-5">
        <h3 class="section-title">Sail With Us</h3>
        <p class="lead">
          One ship, thousands of experiences! The thrill of sailing on a legendary ship, and savouring moments of serenity.
        </p>
        <p class="sub-lead">A journey you'll always remember</p>
      </div>
    </div>
    <div class="itinerary_active owl-carousel">
      @foreach ($itineraries as $itinerary)
      <div class="item">
        <div class="itinerary_card">
          <div class="card_image" style="background-image:url('{{ asset('storage/' . $itinerary->image) }}')">
          </div>
          <div class="itinerary_info">
            <p>{{ $itinerary->subtitle }}</p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

<!-- end -->

@include('calendar')

@endsection