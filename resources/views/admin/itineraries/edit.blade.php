@extends('app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Itinerary</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.itineraries.index') }}">Back</a></li>
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
                  <h3 class="card-title">Edit Itinerary</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.itineraries.update', $itinerary->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf  
                  @method('put')
                  <div class="card-body">
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
                      <label for="subtitle">Subtitle</label>
                      <input type="text" class="form-control @error('subtitle') is-invalid @enderror" name="subtitle" value="{{ old('subtitle', $itinerary->subtitle) }}" placeholder="Enter Subtitle">
                    </div>
                    <!-- error message untuk subtitle -->
                    @error('subtitle')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
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