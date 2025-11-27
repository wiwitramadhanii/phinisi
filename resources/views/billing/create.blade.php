@extends('layout')

@section('content')

<div class="billing-area">
    <div class="container">
      <div class="row gx-5">
        <!-- Form Data Diri -->
        <div class="col-lg-6">
          <div class="card billing-card">
            <div class="card-header text-white">
              <h4 class="mb-0 text-white"><i class="bi bi-person-square me-2"></i>Personal Data Form</h3>
            </div>
            <div class="card-body">
              <form action="{{ route('bookings.store') }}" method="POST">
                @csrf
                <input type="hidden" name="package_id"      value="{{ $package->id }}">
                <input type="hidden" name="selected_date"   value="{{ request('selected_date') }}">
                <input type="hidden" name="pax_category_id" id="pax_category_id" value="{{ old('pax_category_id', $paxCategory->id) }}">
                <input type="hidden" name="total_price"     id="total_price"     value="0">
                <input type="hidden" name="pax_category"    value="{{ $paxCategory->pax_range }}">
  
                <div class="mb-3">
                  <label for="name"  class="form-label">Full Name</label>
                  <input type="text" name="name" id="name" class="form-control shadow-sm" placeholder="Enter Full Name" required>
                </div>
  
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" name="email" id="email" class="form-control shadow-sm" placeholder="example@domain.com" required>
                </div>
  
                <div class="mb-3">
                  <label for="phone" class="form-label">Phone Number</label>
                  <input type="tel" name="phone" id="phone" class="form-control shadow-sm" placeholder="+62 812 3456 7890" required>
                </div>
  
                <div class="mb-3">
                    <label for="pax" class="form-label">Number of Pax</label>
                    <div class="input-group pax-spinner" style="max-width: 160px;">
                      <button type="button" class="btn btn-outline-secondary" id="pax-decrease">–</button>
                      <input type="text" name="num_pax" id="pax" class="form-control text-center shadow-sm" value="{{ $minPax }}" readonly required>
                      <button type="button" class="btn btn-outline-secondary" id="pax-increase">+</button>
                    </div>
                </div>
  
                <div class="mb-4">
                  <label class="form-label">Total Price:</label>
                  <p id="display_total_price" class="fs-4 text-primary fw-bold">Rp 0</p>
                </div>
  
                <button type="submit" class="btn btn-gradient w-100 py-2 text-white">Checkout Now</button>
              </form>
            </div>
          </div>
        </div>
  
        <!-- Detail Paket -->
        <div class="col-lg-6">
          <div class="card detail-card">
            <div class="card-body">
              <h3 class="card-title mb-3">{{ $package->package_name }}</h3>
              <ul class="list-unstyled">
                <li class="mb-2"><i class="bi bi-geo-alt-fill me-2 text-secondary"></i><strong>Route:</strong> {{ $package->route }}</li>
                <li class="mb-2"><i class="bi bi-clock-fill me-2 text-secondary"></i><strong>Time:</strong> {{ $package->time }}</li>
                <li class="mb-2"><i class="bi bi-calendar-event-fill me-2 text-secondary"></i><strong>Date:</strong> {{ request('selected_date') }}</li>
                <li class="mb-2"><i class="bi bi-people-fill me-2 text-secondary"></i><strong>Pax Category:</strong>
                  <span id="selected_pax_category">{{ $paxCategory->pax_range }} pax (Rp {{ number_format($paxCategory->price_per_pax,0,',','.') }}/pax)</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <!-- Styles -->
    <style>
      .billing-area {
        padding-top: calc(70px + 50px); 
        padding: 50px 0;
        background: #f8f9fa;
      }
      .billing-card, .detail-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
      }
  
      .billing-card .card-header {
        background: navy;
      }

      .billing-area h5 {
        font-size: 10px;
      }
      .billing-card .form-control {
        border-radius: 6px;
        transition: transform 0.2s, box-shadow 0.2s;
        background: rgb(237, 235, 235);
      }
      .billing-card .form-control:focus {
        transform: translateY(-2px);
        box-shadow: 0 2px 8px rgba(0,153,255,0.3);
      }
  
      .btn-gradient {
        background: navy;
        border: none;
        font-weight: 600;
        border-radius: 6px;
        transition: opacity 0.2s;
      }
  
      .btn-gradient:hover {
        opacity: 0.9;
      }
  
      .detail-card .list-unstyled li {
        display: flex;
        align-items: center;
      }
      .detail-card .list-unstyled li strong {
        display: inline-block;
        margin-right: 0.5rem;
      }
  
      .detail-card .list-unstyled li i {
        font-size: 1.2rem;
      }
      #pax {
        color: black;
      }
      .pax-spinner .btn {
        width: 40px;
        padding: 0;
        font-size: 1.5rem;
        line-height: 1;
      }
      .pax-spinner .form-control {
        border-left: none;
        border-right: none;
      }
      @media (max-width: 991.98px) {
        .billing-area .container {
          margin: 70px auto 0;
          padding-left: 1rem;
          padding-right: 1rem;
          box-sizing: border-box;
        }
        .billing-area .row {
          --bs-gutter-x: 1rem;
          flex-direction: column;
          padding: 1rem;
        }
        .billing-area .col-lg-6 {
          max-width: 100%;
          flex: 0 0 100%;
          margin-bottom: 1.5rem;
        }
      }
      @media (max-width: 575.98px) {
        .billing-area {
          padding: 30px 0;
        }
        .billing-card .card-header h4, .detail-card .card-title {
          font-size: 1.125rem;
        }
        .billing-card .mb-3 label, .billing-card .form-control, .detail-card .list-unstyled li {
          font-size: 0.9rem;
        }
        .pax-spinner {
          max-width: 100%;
        }    
        .pax-spinner .btn {
          width: 32px;
        }
      }
    </style>
  
  <script>
    (function() {
    
        const minPax = {{ $minPax }};             
        const maxPax = {{ $maxPax }};             
        const pricePerPax = {{ $pricePerPax }};   
    
        const paxInput = document.getElementById('pax');                    
        const priceDisplay = document.getElementById('display_total_price'); 
        const hiddenTotalInput = document.getElementById('total_price');     
    
        /**
         * @param {number} pax 
         */
        function updateTotalPrice(pax) {
            const total = pax * pricePerPax;
    
            const formatted = new Intl.NumberFormat('id-ID').format(total);
    
            priceDisplay.textContent = `Rp ${formatted}`;
            hiddenTotalInput.value = total; 
        }
    
        document.getElementById('pax-increase').addEventListener('click', () => {
            let currentPax = parseInt(paxInput.value, 10);
    
            if (currentPax < maxPax) {
                currentPax++;
                paxInput.value = currentPax;
                updateTotalPrice(currentPax);
            }
        });
    
        document.getElementById('pax-decrease').addEventListener('click', () => {
            let currentPax = parseInt(paxInput.value, 10);
    
            if (currentPax > minPax) {
                currentPax--;
                paxInput.value = currentPax;
                updateTotalPrice(currentPax);
            }
        });
    
        const initialPax = parseInt(paxInput.value, 10);
        updateTotalPrice(initialPax);
    
    })();
  </script>
    
</div>
  
@endsection
