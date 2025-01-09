@extends('layout')

@section('content')

<!-- slider_area_start -->
<div class="slider_area">
    <div class="slider_active owl-carousel">
    @foreach ($sliders as $slider)
      <div
      style="background-image: url({{ asset('storage/' . $slider->image) }})"
      class="single_slider d-flex align-items-center overlay">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-xl-12 col-md-12">
            <div class="slider_text text-center">
              <h3>{{ $slider->title }}</h3>
            </div>
          </div>
        </div>
      </div>
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
            <!-- Card 1 -->
            <div class="item">
              <div class="itinerary_card">
                <img src="https://via.placeholder.com/400x200" alt="itinerary 1">
                <div class="itinerary_info">
                  <h5>Itinerary 1</h5>
                  <p>Beautiful beach with crystal clear water.</p>
                </div>
              </div>
            </div>
            <!-- Card 2 -->
            <div class="item">
              <div class="itinerary_card">
                <img src="https://via.placeholder.com/400x200" alt="itinerary 2">
                <div class="itinerary_info">
                  <h5>itinerary 2</h5>
                  <p>Scenic mountain views and hiking trails.</p>
                </div>
              </div>
            </div>
            <!-- Card 3 -->
            <div class="item">
              <div class="itinerary_card">
                <img src="https://via.placeholder.com/400x200" alt="itinerary 3">
                <div class="itinerary_info">
                  <h5>itinerary 3</h5>
                  <p>Explore the beautiful underwater world.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<!-- end -->

@include('calendar')

@endsection