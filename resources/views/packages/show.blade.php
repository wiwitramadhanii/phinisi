@extends('layout')

@section('content')

{{-- @php
        // Ambil semua path gambar dari relasi documentations
        $allImages = $documentations->pluck('file_path')->toArray();

        // Gambar besar: elemen pertama (jika ada)
        $bigImage = $allImages[0] ?? null;

        // Gambar kecil: ambil elemen 1–4, lalu pad supaya selalu ada 4 item
        $smallImages = array_slice($allImages, 1, 4);
        $smallImages = array_pad($smallImages, 4, null);
@endphp --}}
@php
  // Ambil, lalu ratakan (flatten) semua file_path
  $allImages = collect($documentations)
                 ->flatMap(fn($doc) => $doc->file_path ?? [])
                 ->toArray();

  $bigImage    = $allImages[0]               ?? null;
  $smallImages = array_slice($allImages, 1, 4);
  $smallImages = array_pad($smallImages, 4, null);
@endphp


<div class="package_details_info">
    <div class="header_package_area">
        <div class="row custom-gap gy-2"> 
            {{-- KIRI: gambar besar --}}
            <div class="col-md-6">
              @if($bigImage)
                <img 
                  src="{{ Storage::url($bigImage) }}" 
                  alt="Gambar Utama" 
                  class="img-fluid w-100 border-radius:20px" 
                  style="border-radius: 10px; height:440px;"
                >
              @else
                <div 
                  class="bg-light d-flex align-items-center justify-content-center rounded" 
                  style="height:100px; border-radius:10px;"
                >
                  <span class="text-muted">Belum ada gambar</span>
                </div>
              @endif
            </div>
            {{-- KANAN: 2×2 grid --}}
            <div class="col-md-6">
                <div class="row custom-gap gy-2">  {{-- g-1 = 0.25rem horizontal gap --}}
                  @foreach($smallImages as $img)
                    <div class="col-6 mb-3">
                      @if($img)
                        <img 
                          src="{{ Storage::url($img) }}" 
                          alt="Gambar Kecil" 
                          class="img-fluid border-radius:10px" 
                          style="
                            height:212px; 
                            object-fit:cover; 
                            width:100%;
                            border-radius: 8px;
                          "
                        >
                      @else
                        <div 
                          class="bg-light d-flex align-items-center justify-content-center rounded" 
                          style="height:200px; border-radius:8px;"
                        >
                          <span class="text-muted">–</span>
                        </div>
                      @endif
                    </div>
                  @endforeach
                </div>
            </div>
        </div>  
    </div>
    <div class="info-container">
        <div class="header-container">
            <h2>{{ $package->package_name }}</h2>
            <div class="event-type">Private Trip</div>
        </div>
        <div class="info-item">
            <i class="fa fa-map-marker"></i> {{ $package->route }}
          </div>
          <div class="info-item">
            <i class="fa fa-clock-o"></i> {{ $package->time }}
          </div>
          <div class="info-item">
            <i class="fa fa-users"></i> {{ $package->pax }} Pax
          </div>
          
    </div>
    <div class="package-include-exclude-rundown">
      <div class="row d-flex align-items-stretch">
        
        <!-- INCLUDE -->
        <div class="col-md-4 d-flex flex-column mb-3 mb-md-0">
          <div class="card shadow-sm border-0 h-100 flex-fill">
            <div class="card-header bg-navy text-white d-flex align-items-center">
              <i class="fa fa-check-circle fa-2x me-3"></i>
              <h5 class="mb-0 text-white">What’s Included</h5>
            </div>
            <div class="card-body">
              @php
                $chunks = collect($package->include)
                            ->chunk(ceil(count($package->include)/2));
              @endphp
              <div class="row">
                @foreach($chunks as $chunk)
                  <div class="col-6">
                    @foreach($chunk as $item)
                      <div class="d-flex align-items-center py-2">
                        <i class="fa fa-check-circle text-navy me-2"></i>
                        <span>{{ $item }}</span>
                      </div>
                    @endforeach
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
    
        <!-- EXCLUDE -->
        <div class="col-md-4 d-flex flex-column mb-3 mb-md-0">
          <div class="card shadow-sm border-0 h-100 flex-fill">
            <div class="card-header bg-navy text-white d-flex align-items-center">
              <i class="fa fa-ban fa-2x me-2"></i>
              <h5 class="mb-0">What’s Excluded</h5>
            </div>
            <div class="card-body">
              <ul class="list-unstyled mb-0">
                @foreach ($package->exclude as $item)
                  <li class="d-flex align-items-center py-2">
                    <i class="fa fa-times-circle-o text-danger me-2"></i>
                    <span>{{ $item }}</span>
                  </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
    
        <!-- RUNDOWN -->
        <div class="col-md-4 d-flex flex-column mb-3 mb-md-0 rundowns">
          <div class="card shadow-sm border-0 h-100 flex-fill">
            <div class="card-header bg-navy text-white d-flex align-items-center">
              <i class="fa fa-ship fa-2x me-2"></i>
              <h5 class="mb-0">Rundown Activity</h5>
            </div>
            <div class="card-body rundown-activity">
              @foreach ($package->rundown as $item)
                <div class="d-flex mb-3 rundown-item">
                  <div class="rundown-time">
                    <strong>{{ $item['time'] }}</strong>
                  </div>
                  <div class="rundown-content">
                    <h6 class="mb-1">{{ $item['activity'] }}</h6>
                    @if(!empty($item['detail']))
                      <small>{{ $item['detail'] }}</small>
                    @endif
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="booking-container">
      <div class="booking-details">
        <div class="header-booking">
          <div class="header-title">Price List</div>
        </div>
        <form action="{{ route('bookings.billing.create', ['package_id' => $package->id]) }}" method="GET" id="bookingForm">
          <div class="body-booking">
            <div class="body-top-booking">
              <div class="pax-controls">
                <select name="pax_category_id" id="pax-categories" required onchange="updatePrice()">
                  <option value="">Choose Pax</option>
                  @foreach ($paxCategories as $category)
                    <option
                      value="{{ $category->id }}"
                      data-price="{{ $category->price_per_pax }}"
                      data-pax-range="{{ $category->pax_range }}">
                      {{ $category->pax_range }} pax (Rp {{ number_format($category->price_per_pax, 0, ',', '.') }}/pax)
                    </option>
                  @endforeach
                </select>                                                                       
              </div>
            </div>
            <div class="body-info-booking">
              <div class="price" id="priceDisplay">Total Price: Rp 0</div>
            </div>
            <div class="body-bottom-booking">
              <div class="date-available">
                <input type="date" name="selected_date" id="selected_date" onchange="checkDateAvailability()">
                <span id="availabilityMessage"></span>
              </div>
              <div class="booking">
                <button type="submit" id="submitButton" class="btn-booking" onclick="return validateForm()">Book Now</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
</div>
<script>
    function updatePrice() {
        const selectElement = document.getElementById("pax-categories");
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const pricePerPax = selectedOption.getAttribute("data-price");
        const paxRange = selectedOption.getAttribute("data-pax-range");

        let paxCount = 1; // Default jika tidak ada kategori dipilih
        if (paxRange) {
            const [minPax] = paxRange.split('-').map(Number);
            paxCount = minPax; // Gunakan batas bawah dari rentang pax
        }

        if (pricePerPax) {
            const totalPrice = parseInt(pricePerPax) * paxCount;
            document.getElementById("priceDisplay").innerText = `Total Price: Rp ${totalPrice.toLocaleString('id-ID')}`;
        } else {
            document.getElementById("priceDisplay").innerText = "Total Price: Rp 0";
        }
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const dateInput = document.getElementById("selected_date");

    let today = new Date().toISOString().split("T")[0];

    dateInput.setAttribute("min", today);
    });
    function validateForm() {
        var paxCategory = document.getElementById("pax-categories").value;
        var selectedDate = document.getElementById("selected_date").value;

        if (paxCategory == "" || selectedDate == "") {
            alert("Please select both Pax category and Date before booking.");
            return false;
        }

        const fullBookedDates = getFullBookedDatesSync(); 
        if (fullBookedDates.includes(selectedDate)) {
            alert("The selected date is fully booked. Please choose another date.");
            return false;
        }

        return true;
    }

    function getFullBookedDatesSync() {
        var fullBookedDates = [];
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "/api/full-booked-dates", false); 
        xhr.onload = function () {
            if (xhr.status === 200) {
                fullBookedDates = JSON.parse(xhr.responseText);
            }
        };
        xhr.send();
        return fullBookedDates;
    }
</script>
<script>
  async function checkDateAvailability() {
      const selectedDate = document.getElementById('selected_date').value;
      const availabilityMessage = document.getElementById('availabilityMessage');
      const submitButton = document.getElementById('submitButton');
      const packageId = {{ $package->id }};  
  
      if (!selectedDate) {
          availabilityMessage.textContent = 'Please select a date.';
          availabilityMessage.style.color = 'gray';
          submitButton.disabled = true;
          return;
      }
  
      const response = await fetch(`/api/check-availability?date=${selectedDate}&package_id=${packageId}`);
      const data = await response.json();
  
      const unavailable = data.unavailablePackages;
  
      const isUnavailable = (id) => unavailable.includes(id);
  
      if (isUnavailable(packageId)) {
          return showUnavailable();
      } else if (isUnavailable(4) && [1, 2, 3].includes(packageId)) { 
          return showUnavailable();
      } else if (isUnavailable(1) && [2, 3].includes(packageId)) {
          return showAvailable();
      } else if ([1, 2, 3].some(id => isUnavailable(id)) && packageId === 4) {
          return showUnavailable();
      } else {
        return showAvailable()
      };
  
      function showUnavailable() {
          availabilityMessage.textContent = "Fully booked. Please choose another date.";
          availabilityMessage.style.color = 'red';
          submitButton.disabled = true;
      }
  
      function showAvailable() {
          availabilityMessage.textContent = "The selected date is available.";
          availabilityMessage.style.color = 'green';
          submitButton.disabled = false;
      }
  }
  </script>
  
@endsection