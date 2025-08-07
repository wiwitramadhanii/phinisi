@extends('app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Slider's Data</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.sliders.index') }}">Back</a></li>
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
                  <h3 class="card-title">Edit Slider</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
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
                      <label for="title">Title</label>
                      <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $slider->title) }}" placeholder="Enter Slider Title">
                    </div>
                    <!-- error message untuk title -->
                    @error('title')
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