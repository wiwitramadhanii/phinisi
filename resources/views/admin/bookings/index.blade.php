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

    <!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Package</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Selected Date</th>
                                    {{-- <th>Pax Category</th> --}}
                                    <th>Pax</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $booking->package->package_name }}</td>
                                    <td>{{ $booking->name }}</td>
                                    <td>{{ $booking->email }}</td>
                                    <td>{{ $booking->phone }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->selected_date)->format('d M Y') }}</td>
                                    {{-- <td>{{ $booking->pax_category }}</td> --}}
                                    <td>{{ $booking->num_pax }}</td>
                                    <td>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                    <td>{{ $booking->is_already_pay == 1 ? 'Paid' : 'Unpaid' }}</td>
                                    <td>
                                        <form id="togglePayForm-{{ $booking->id }}"
                                            action="{{ route('admin.bookings.togglePay', $booking->id) }}"
                                            method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        
                                        @if($booking->is_already_pay)
                                          <button type="button" class="btn btn-warning btn-sm"
                                                  onclick="confirmTogglePayment({{ $booking->id }}, 'unpaid')">
                                            <i class="fas fa-undo"></i> Unpaid
                                          </button>
                                        @else
                                          <button type="button" class="btn btn-success btn-sm"
                                                  onclick="confirmTogglePayment({{ $booking->id }}, 'paid')">
                                            <i class="fas fa-check"></i> Paid
                                          </button>
                                        @endif
                                        </form>
                                        <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-pen"></i> Edit
                                        </a>
                                        <form id="delete-form-{{ $booking->id }}" action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $booking->id }})">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr> 
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

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
@endpush

@endsection

