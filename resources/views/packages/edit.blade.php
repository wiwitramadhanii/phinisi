@extends('app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Package</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('packages.index') }}">Back</a></li>
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
            <!-- left column -->
            <div class="col-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Package</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('packages.update', $package->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf  
                    $@method('put')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="banner">Banner</label>
                            <input type="file" class="form-control @error('banner') is-invalid @enderror" name="banner">
                            <!-- error message untuk banner -->
                            @error('banner')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                            <!-- error message untuk image -->
                            @error('image')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="name">Package Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter Package Name">
                            @error('name')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                
                        <div class="form-group">
                            <label for="time">Time</label>
                            <input type="text" class="form-control @error('time') is-invalid @enderror" name="time" value="{{ old('time') }}" placeholder="Enter Trip Time">
                            @error('time')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                
                        <div class="form-group">
                            <label for="route">Route</label>
                            <input type="text" class="form-control @error('route') is-invalid @enderror" name="route" value="{{ old('route') }}" placeholder="Enter Trip Route">
                            @error('route')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                
                        <div class="form-group">
                            <label for="min_price">Price</label>
                            <input type="number" class="form-control @error('min_price') is-invalid @enderror" name="min_price" value="{{ old('min_price') }}" placeholder="Enter Minimum Price">
                            @error('min_price')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                
                        <div class="form-group">
                            <label for="include">Include</label>
                            <textarea class="form-control @error('include') is-invalid @enderror" name="include" rows="3" placeholder="Enter items included in the package">{{ old('include') }}</textarea>
                            @error('include')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                
                        <div class="form-group">
                            <label for="exclude">Exclude</label>
                            <textarea class="form-control @error('exclude') is-invalid @enderror" name="exclude" rows="3" placeholder="Enter items excluded from the package">{{ old('exclude') }}</textarea>
                            @error('exclude')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                
                        <div class="form-group">
                            <label for="rundown">Rundown</label>
                            <textarea class="form-control @error('rundown') is-invalid @enderror" name="rundown" rows="5" placeholder='Example: [{"time": "08:00", "activity": "Departure"}, {"time": "10:00", "activity": "Island Tour"}]'>{{ old('rundown') }}</textarea>
                            @error('rundown')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->
                
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
</div>
@endsection