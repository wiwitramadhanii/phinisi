@extends('app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Booking</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.bookings.index') }}">Back</a></li>
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
            <!-- full width -->
            <div class="col-12">
              <!-- form card -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Form Edit Booking</h3>
                </div>
                <!-- /.card-header -->
                <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">

                        {{-- Package --}}
                        <div class="form-group">
                            <label for="package_id">Package</label>
                            <select name="package_id" id="package_id" class="form-control @error('package_id') is-invalid @enderror">
                                @foreach($packages as $package)
                                  <option value="{{ $package->id }}"
                                    {{ old('package_id', $booking->package_id) == $package->id ? 'selected' : '' }}>
                                    {{ $package->package_name }}
                                  </option>
                                @endforeach
                            </select>
                            @error('package_id')
                              <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Name --}}
                        <div class="form-group">
                            <label for="name">Customer Name</label>
                            <input type="text" name="name" id="name"
                              class="form-control @error('name') is-invalid @enderror"
                              value="{{ old('name', $booking->name) }}"
                              placeholder="Enter customer name">
                            @error('name')
                              <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email"
                              class="form-control @error('email') is-invalid @enderror"
                              value="{{ old('email', $booking->email) }}"
                              placeholder="Enter email address">
                            @error('email')
                              <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" id="phone"
                              class="form-control @error('phone') is-invalid @enderror"
                              value="{{ old('phone', $booking->phone) }}"
                              placeholder="Enter phone number">
                            @error('phone')
                              <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Selected Date --}}
                        <div class="form-group">
                            <label for="selected_date">Selected Date</label>
                            <input type="date" name="selected_date" id="selected_date"
                              class="form-control @error('selected_date') is-invalid @enderror"
                              value="{{ old('selected_date', $booking->selected_date) }}">
                            @error('selected_date')
                              <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Pax Category --}}
                        <div class="form-group">
                            <label for="pax_category">Pax Category</label>
                            <select name="pax_category" id="pax_category"
                              class="form-control @error('pax_category') is-invalid @enderror">
                                <option value="10-14" {{ old('pax_category', $booking->pax_category)=='10-14' ? 'selected':'' }}>10-14</option>
                                <option value="15-19" {{ old('pax_category', $booking->pax_category)=='15-19' ? 'selected':'' }}>15-19</option>
                                <option value="20-24" {{ old('pax_category', $booking->pax_category)=='20-24' ? 'selected':'' }}>20-24</option>
                                <option value="25-50" {{ old('pax_category', $booking->pax_category)=='25-50' ? 'selected':'' }}>25-50</option>
                            </select>
                            @error('pax_category')
                              <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Number of Pax --}}
                        <div class="form-group">
                            <label for="num_pax">Number of Pax</label>
                            <input type="number" name="num_pax" id="num_pax"
                              class="form-control @error('num_pax') is-invalid @enderror"
                              value="{{ old('num_pax', $booking->num_pax) }}"
                              placeholder="Enter number of pax">
                            @error('num_pax')
                              <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Total Price --}}
                        <div class="form-group">
                            <label for="total_price">Total Price (Rp)</label>
                            <input type="number" name="total_price" id="total_price"
                              class="form-control @error('total_price') is-invalid @enderror"
                              value="{{ old('total_price', $booking->total_price) }}"
                              placeholder="Enter total price">
                            @error('total_price')
                              <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                          <i class="fas fa-save"></i> Update
                        </button>
                    </div>
                </form>

              </div>
              <!-- /.card -->
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
</div>
@endsection
