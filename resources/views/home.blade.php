@extends('layout')

@section('content')

<!-- slider_area_start -->
<div class="slider_area">
    <div class="slider_active owl-carousel">
    @foreach ($sliders as $slider)
      <div
      style="background-image: url({{ asset('storage/' . $slider->image) }})"
      class="single_slider d-flex align-items-center overlay">
      {{-- <div class="container">
        <div class="row align-items-center">
          <div class="col-xl-12 col-md-12">
            <div class="slider_text text-center">
              <h3>{{ $slider->title }}</h3>
            </div>
          </div>
        </div>
      </div> --}}
     </div>
    @endforeach
    </div>
</div>
<!-- slider_area_end -->

<!-- itinerary -->
<div class="itinerary_area">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="section_title text-center mb_70">
            <h3>Popular itinerary</h3>
            <p>
              Suffered alteration in some form, by injected humour or good day
              randomised booth anim 8-bit hella wolf moon beard words.
            </p>
          </div>
        </div>
      </div>
      <!-- Owl Carousel Slider -->
      <div class="row">
        <div class="col-lg-12">
          <div class="itinerary_active owl-carousel">
            @foreach ($itineraries as $itinerary)
            <div class="item">
              <div class="itinerary_card">
                <img src="{{ asset('storage/' . $itinerary->image) }}">
                <div class="itinerary_info">
                  <p>{{ $itinerary->subtitle }}</p>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
</div>
<!-- end -->

@include('calendar')

@endsection