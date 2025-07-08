@extends('app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add File</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('admin.documentations.index') }}">Documentation</a></li>
              <li class="breadcrumb-item active">Add Documentation</li>
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
                    <div class="card-header">
                        <h3 class="card-title">Form Add Documentation</h3>
                    </div>
                    <form action="{{ route('admin.documentations.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="package_id">Package</label>
                                <select name="package_id" id="package_id" class="form-control" required>
                                    <option value="">Select Package</option>
                                    @foreach ($packages as $package)
                                        <option value="{{ $package->id }}">{{ $package->package_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Images</label>
                                <div id="images-list">
                                  <div class="input-group mb-2">
                                    <input type="file" name="file_path[]" class="form-controll" placeholder="Item Image" required>
                                    <div class="input-group-append">
                                      <button class="btn btn-danger remove-image" type="button">&times;</button>
                                    </div>
                                  </div>
                                </div>
                                <button id="add-image" class="btn btn-secondary btn-sm" type="button">+ Add Image</button>
                            </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('paxCategories.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('add-image').addEventListener('click', () => {
        let wrapper = document.createElement('div');
        wrapper.classList.add('input-group', 'mb-2');
        wrapper.innerHTML = `
          <input type="file" name="file_path[]" class="form-controll" placeholder="Item Image" required>
          <div class="input-group-append">
            <button class="btn btn-danger remove-image" type="button">&times;</button>
          </div>`;
          document.getElementById('images-list').appendChild(wrapper);
      });
      document.body.addEventListener('click', e => {
        if (e.target.classList.contains('remove-image')) e.target.closest('.input-group').remove();
      });
    });
  </script>
@endpush

@endsection
