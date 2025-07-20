@extends('app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Booking Data</h1>
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
                                    <th>Package Name</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Selected Date</th>
                                    <th>Pax Category</th>
                                    <th>Number Pax</th>
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
                                    <td>{{ $booking->pax_category }}</td>
                                    <td>{{ $booking->num_pax }}</td>
                                    <td>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                    <td>{{ $booking->is_already_pay == 1 ? 'Paid' : 'Unpaid' }}</td>
                                    <td>
                                        <form action="{{ route('admin.bookings.togglePay', $booking->id) }}"
                                            method="POST" style="display:inline;">
                                          @csrf
                                          @method('PATCH')
                                          @if($booking->is_already_pay)
                                              <button class="btn btn-warning btn-sm"
                                                      onclick="return confirm('Tandai sebagai Unpaid?')">
                                                  <i class="fas fa-undo"></i> Unpaid
                                              </button>
                                          @else
                                              <button class="btn btn-success btn-sm"
                                                      onclick="return confirm('Tandai sebagai Paid?')">
                                                  <i class="fas fa-check"></i> Paid
                                              </button>
                                          @endif
                                      </form>
                                        <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-pen"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
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

@endsection

