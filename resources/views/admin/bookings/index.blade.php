@extends('app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Booking's Data</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content pb-4">
      <div class="container-fluid">

          {{-- Filter Tanggal Booking --}}
          <div class="booking-filter">

              <div class="booking-filter-header">
                  <h6 class="booking-filter-title">
                    Filter by Order Date
                  </h6>
              </div>

              <div class="booking-filter-body">
                  <form
                      action="{{ route('admin.bookings.index') }}"
                      method="GET"
                  >
                      <div class="row">

                          <div class="col-md-6 mb-2">
                              <label for="date_from">
                                  Start Date
                              </label>

                              <input
                                  type="date"
                                  name="date_from"
                                  id="date_from"
                                  class="form-control"
                                  value="{{ request('date_from') }}"
                              >
                          </div>

                          <div class="col-md-6 mb-2">
                              <label for="date_to">
                                  Due Date
                              </label>

                              <input
                                  type="date"
                                  name="date_to"
                                  id="date_to"
                                  class="form-control"
                                  value="{{ request('date_to') }}"
                                  min="{{ request('date_from') }}"
                              >
                          </div>

                      </div>

                      <div class="mt-3">
                          <button type="submit" class="btn btn-primary btn-sm">
                              <i class="fas fa-filter mr-1"></i>
                              Filter
                          </button>

                          <a
                              href="{{ route('admin.bookings.index') }}"
                              class="btn btn-outline-secondary btn-sm"
                          >
                              <i class="fas fa-sync-alt mr-1"></i>
                              Reset
                          </a>
                      </div>
                  </form>
              </div>
          </div>

          {{-- Daftar Booking --}}
          <div class="booking-list">

              @forelse ($bookings as $booking)

                  <div class="booking-item">

                      {{-- Nama, Paket, dan Status --}}
                      <div class="booking-top">
                          <div>
                              <h5 class="booking-customer">
                                  {{ $booking->name }}
                              </h5>

                              <p class="booking-package">
                                  {{ $booking->package->package_name ?? 'Paket tidak tersedia' }}
                              </p>

                              <p class="booking-email mb-1">
                                <i class="fas fa-envelope mr-1"></i>
                                {{ $booking->email ?? 'Email tidak tersedia' }}
                              </p>

                              <p class="booking-phone mb-0">
                                <i class="fas fa-phone mr-1"></i>
                                {{ $booking->phone ?? 'Nomor telepon tidak tersedia' }}
                              </p>
                          </div>

                          @if ($booking->is_already_pay)
                              <span class="booking-status paid">
                                  Paid
                              </span>
                          @else
                              <span class="booking-status unpaid">
                                  Unpaid
                              </span>
                          @endif
                      </div>

                      <hr class="booking-divider">

                      {{-- Waktu Booking dan Tanggal Perjalanan --}}
                      <div class="booking-date-info">

                          <div>
                              <i class="far fa-calendar-alt"></i>
                              Booking Time :
                              @if ($booking->created_at)
                                  {{ \Carbon\Carbon::parse($booking->created_at)->format('d-m-Y H:i') }}
                              @else
                                  
                              @endif
                          </div>

                          <div class="booking-trip-date">
                              Trip Date :
                              {{ \Carbon\Carbon::parse($booking->selected_date)->format('d-m-Y') }}
                          </div>

                      </div>

                      {{-- Jumlah Peserta dan Total Harga --}}
                      <div class="booking-bottom">
                          <div class="booking-pax">
                              {{ $booking->num_pax }}
                              Pax
                          </div>

                          <div class="booking-price">
                              Rp{{ number_format($booking->total_price, 0, ',', '.') }}
                          </div>
                      </div>

                      {{-- Action Admin --}}
                      <div class="booking-actions">

                          <form
                              id="togglePayForm-{{ $booking->id }}"
                              action="{{ route('admin.bookings.togglePay', $booking->id) }}"
                              method="POST"
                              class="d-inline"
                          >
                              @csrf
                              @method('PATCH')

                              @if ($booking->is_already_pay)
                                  <button
                                      type="button"
                                      class="btn btn-outline-warning btn-sm"
                                      onclick="confirmTogglePayment({{ $booking->id }}, 'unpaid')"
                                  >
                                      <i class="fas fa-undo mr-1"></i>
                                      Unpaid
                                  </button>
                              @else
                                  <button
                                      type="button"
                                      class="btn btn-outline-success btn-sm"
                                      onclick="confirmTogglePayment({{ $booking->id }}, 'paid')"
                                  >
                                      <i class="fas fa-check mr-1"></i>
                                      Paid
                                  </button>
                              @endif
                          </form>

                          <a
                              href="{{ route('admin.bookings.edit', $booking->id) }}"
                              class="btn btn-outline-primary btn-sm"
                          >
                              <i class="fas fa-pen mr-1"></i>
                              Edit
                          </a>

                          <form
                              id="delete-form-{{ $booking->id }}"
                              action="{{ route('admin.bookings.destroy', $booking->id) }}"
                              method="POST"
                              class="d-inline"
                          >
                              @csrf
                              @method('DELETE')

                              <button
                                  type="button"
                                  class="btn btn-outline-danger btn-sm"
                                  onclick="confirmDelete({{ $booking->id }})"
                              >
                                  <i class="fas fa-trash mr-1"></i>
                                  Delete
                              </button>
                          </form>

                      </div>

                  </div>

              @empty

                  <div class="booking-empty">
                      <i class="far fa-calendar-times"></i>

                      <div class="font-weight-bold mb-1">
                        No booking data
                      </div>

                      <div class="small">
                        There are no bookings for the selected date range.
                        Try changing the date or press Reset.
                      </div>
                  </div>

              @endforelse

          </div>

      </div>
    </section>

</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  function confirmTogglePayment(id, status) {
    const form = document.getElementById('togglePayForm-' + id);
    let title = 'Change Payment Status';
    let htmlMessage = status === 'paid'
      ? 'Are you sure you want to mark this booking as <b>Paid</b>?'
      : 'Are you sure you want to mark this booking as <b>Unpaid</b>?';
    let confirmButtonText = status === 'paid' ? 'Yes, mark as Paid' : 'Yes, mark as Unpaid';
    let confirmButtonColor = status === 'paid' ? '#28a745' : '#ffc107';

    Swal.fire({
      title: title,
      html: htmlMessage,
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: confirmButtonColor,
      cancelButtonColor: '#6c757d',
      confirmButtonText: confirmButtonText,
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit();
      }
    });
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function confirmDelete(id) {
      Swal.fire({
          title: 'Are you sure?',
          text: "This order data will be permanently deleted!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Yes, Delete!',
          cancelButtonText: 'Cancel'
      }).then((result) => {
          if (result.isConfirmed) {
              document.getElementById('delete-form-' + id).submit();
          }
      });
  }
</script>
<style>
  .booking-wrapper {
      background: #0b0b0b;
      color: #f5f5f5;
      min-height: 100vh;
  }

  .booking-wrapper .content-header {
      padding-bottom: 12px;
  }

  .booking-wrapper .content-header h1 {
      color: #f5f5f5;
      font-size: 25px;
      font-weight: 600;
  }

  .booking-wrapper .breadcrumb {
      background: transparent;
  }

  .booking-wrapper .breadcrumb-item,
  .booking-wrapper .breadcrumb-item a,
  .booking-wrapper .breadcrumb-item.active {
      color: #bdbdbd;
  }

  /* Filter tanggal */
  .booking-filter {
      background: #ffffff;
      /* border: 1px solid #292929; */
      border-radius: 8px;
      margin-bottom: 18px;
      overflow: hidden;
  }

  .booking-filter-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 16px 10px;
  }

  .booking-filter-title {
      font-size: 15px;
      font-weight: 500;
      margin: 0;
  }

  .booking-filter-body {
      padding: 0 16px 16px;
  }

  .booking-filter .form-control {
      background: #ffffff;
      color: #0e0e0e;
      border: 1px solid #d4d4d4;
      border-radius: 25px;
      height: 42px;
      padding: 8px 14px;
  }

  .booking-filter .form-control:focus {
      border-color: #777;
      box-shadow: none;
  }

  .booking-filter label {
      color: #787878;
      font-size: 14px;
      margin-bottom: 5px;
  }

  .booking-filter .btn {
      border-radius: 20px;
      margin-right: 5px;
  }

  /* Kartu booking */
  .booking-list {
      display: flex;
      flex-direction: column;
      gap: 12px;
  }

  .booking-item {
      background: #ffffff;
      border-radius: 8px;
      padding: 12px;
      transition: border-color 0.2s ease;
  }

  .booking-item:hover {
      border-color: #555;
  }

  .booking-top {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      gap: 12px;
  }

  .booking-customer {
      font-size: 17px;
      font-weight: 500;
      color: #000000;
      margin: 0 0 5px;
      overflow-wrap: anywhere;
  }

  .booking-package {
      color: #989797;
      font-size: 14px;
      margin: 0;
  }

  .booking-status {
      display: inline-block;
      padding: 4px 9px;
      border-radius: 14px;
      font-size: 15px;
      white-space: nowrap;
      line-height: 1.2;
  }

  .booking-status.paid {
      background: #d8f1de;
      color: #009612;
  }

  .booking-status.unpaid {
      background: #f5d7d7;
      color: #bb4b00;
  }

  .booking-divider {
      border: 0;
      border-top: 1px solid #e6e4e4;
      margin: 17px 0 13px;
  }

  .booking-date-info {
      color: #979595;
      font-size: 14px;
      line-height: 1.8;
  }

  .booking-date-info i {
      width: 18px;
      margin-right: 4px;
      color: #979595;
  }

  .booking-trip-date {
      padding-left: 22px;
      color: #000000;
  }

  .booking-bottom {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      margin-top: 12px;
  }

  .booking-pax {
      color: #979595;
      font-size: 14px;
  }

  .booking-price {
      color: #000000;
      font-size: 16px;
      font-weight: 700;
      text-align: right;
      overflow-wrap: anywhere;
  }

  /* Tombol admin */
  .booking-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 6px;
      margin-top: 13px;
      padding-top: 11px;
      border-top: 1px solid #e6e4e4;
  }

  .booking-actions .btn {
      border-radius: 5px;
      font-size: 12px;
  }

  .booking-empty {
      background: #101010;
      border: 1px solid #303030;
      border-radius: 8px;
      color: #aaa;
      padding: 35px 15px;
      text-align: center;
  }

  .booking-empty i {
      display: block;
      font-size: 28px;
      margin-bottom: 10px;
  }

  @media (max-width: 576px) {
      .booking-wrapper .content-header h1 {
          font-size: 21px;
      }

      .booking-filter-header {
          padding: 13px 12px 9px;
      }

      .booking-filter-body {
          padding: 0 12px 13px;
      }

      .booking-item {
          padding: 11px;
      }

      .booking-customer {
          font-size: 15px;
      }

      .booking-package,
      .booking-date-info,
      .booking-pax {
          font-size: 13px;
      }

      .booking-price {
          font-size: 14px;
      }

      .booking-top {
          gap: 8px;
      }
  }
</style>

@endpush

@endsection

