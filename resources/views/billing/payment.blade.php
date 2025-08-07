@extends('layout')

@section('content')
<div class="payment-area">
    <div class="container">
      <div class="row gx-5">
        <!-- Detail Pemesanan -->
        <div class="col-lg-6 mb-4">
          <div class="card shadow-sm">
            <div class="card-header bg-gradient-primary text-white d-flex align-items-center">
              <i class="bi bi-receipt-cutoff me-2 fs-4"></i>
              <h5 class="mb-0 text-white">Order Detail</h5>
            </div>
            <div class="card-body">
              <ul class="list-unstyled mb-0">
                <li class="d-flex justify-content-between mb-2">
                  <strong>Name:</strong> <span>{{ $booking->name }}</span>
                </li>
                <li class="d-flex justify-content-between mb-2">
                  <strong>Email:</strong> <span>{{ $booking->email }}</span>
                </li>
                <li class="d-flex justify-content-between mb-2">
                  <strong>Phone:</strong> <span>{{ $booking->phone }}</span>
                </li>
                <li class="d-flex justify-content-between mb-2">
                  <strong>Package:</strong> <span>{{ $booking->package->package_name }}</span>
                </li>
                <li class="d-flex justify-content-between mb-2">
                  <strong>Time:</strong> <span>{{ $booking->package->time }}</span>
                </li>
                <li class="d-flex justify-content-between mb-2">
                  <strong>Date:</strong> <span>{{ $booking->selected_date }}</span>
                </li>
                <li class="d-flex justify-content-between mb-2">
                  <strong>Pax Category:</strong> <span>{{ $booking->pax_category }}</span>
                </li>
                <li class="d-flex justify-content-between mb-2">
                  <strong>Number Pax:</strong> <span>{{ $booking->num_pax }}</span>
                </li>
                <li class="d-flex justify-content-between mt-3">
                  <strong>Total Price:</strong>
                  <span class="fs-5 text-gradient-primary">Rp {{ number_format($booking->total_price,0,',','.') }}</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
  
        <!-- Informasi Pembayaran -->
        <div class="col-lg-6 mb-4">
          <div class="card shadow-sm">
            <div class="card-header bg-gradient-success text-white d-flex align-items-center">
              <i class="bi bi-credit-card-2-front-fill me-2 fs-4"></i>
              <h5 class="mb-0 text-white">Payment Information</h5>
            </div>
            <div class="card-body">
              <!-- Bank Mandiri -->
              <div class="d-flex align-items-center mb-3">
                {{-- <img src="https://upload.wikimedia.org/wikipedia/commons/8/8b/Mandiri_logo.svg" alt="Bank Mandiri" class="bank-logo me-3"> --}}
                <div>
                  <div><strong>Bank:</strong> Mandiri</div>
                  <div><strong>Acount Number:</strong> 1520 0186 49828</div>
                  <div><strong>On Behalf Of:</strong> PT. Phinisi Hakata</div>
                </div>
              </div>
  
              <!-- QR Code (opsional) -->
              <!-- <div class="text-center mb-3">
                <img src="path/to/mandiri-qr.png" alt="Mandiri QRIS" class="qr-code">
              </div> -->
  
              <p class="mb-3">
                <strong>Payment Amount:</strong>
                <span class="fs-5 text-gradient-success">Rp {{ number_format($booking->total_price,0,',','.') }}</span>
              </p>
  
              <div class="mb-4">
                <small class="text-muted">
                  Setelah transfer, silakan klik tombol di bawah untuk konfirmasi dan unggah bukti pembayaran.
                </small>
              </div>
  
              <a href="https://wa.me/6282345600773?text=Saya%20telah%20melakukan%20pembayaran%20untuk%20pemesanan%20paket%20trip%20{{ urlencode($booking->package->package_name) }}%20tanggal%20{{ urlencode($booking->selected_date) }}.%20Jumlah%20pax%20:{{ $booking->num_pax }}.%20Total%20harga%20Rp%20{{ number_format($booking->total_price, 0, ',', '.') }}"
                 class="btn btn-success d-block mb-2" target="_blank">
                <i class="bi bi-whatsapp me-2"></i>Konfirmasi via WhatsApp
              </a>
              <a href="{{ url('/') }}" class="btn btn-outline-secondary d-block">
                <i class="bi bi-house-door-fill me-2"></i>Back to Home
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <!-- Styles -->
    <style>
      .payment-area {
        padding: 50px 0;
        background: #f8f9fa;
      }
      @media (max-width: 991.98px) {
        .payment-area {
          padding-top: calc(60px + 40px);
          padding-left: 1rem;
          padding-right: 1rem;
          box-sizing: border-box;
        }
      }
      .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
      }
      .card-header {
        padding: 1rem 1.5rem;
        background: navy;
      }
      .bank-logo {
        width: 60px;
        object-fit: contain;
      }
      .qr-code {
        width: 120px;
        border: 1px solid #ddd;
        border-radius: 8px;
      }
      .text-gradient-primary {
        background: linear-gradient(90deg, navy);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
      }
      .text-gradient-success {
        background: linear-gradient(90deg, #28a745);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
      }
    </style>
</div>
  
@endsection
