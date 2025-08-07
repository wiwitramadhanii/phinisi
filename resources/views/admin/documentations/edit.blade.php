@extends('app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit File</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('admin.documentations.index') }}">Documentation</a></li>
              <li class="breadcrumb-item active">Edit Documentation</li>
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
                        <h3 class="card-title">Form Edit Documentation</h3>
                    </div>
                    <form action="{{ route('admin.documentations.update', $documentation->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                          
                          <div class="form-group">
                            <label for="package_id">Package</label>
                            <input type="hidden" name="package_id" value="{{ $documentation->package_id }}">
                            <input type="text" class="form-control" value="{{ $packageName }}" readonly>
                          </div>
                        
                          <div class="form-group">
                            <label>Images</label>
                            <div id="images-list">
                                {{-- Tampilkan gambar lama --}}
                                @if(!empty($images))
                                <div class="d-flex flex-wrap mb-3" style="gap: 10px;">
                                  @foreach($images as $img)
                                    <div class="position-relative" style="width: 120px;">
                                      <div style="border-radius: 8px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.15);">
                                        <img src="{{ asset('storage/' . $img) }}" alt="Image" 
                                             style="height: 100px; object-fit: cover; width: 100%; display: block;">
                                        <input type="hidden" name="existing_images[]" value="{{ $img }}">
                                      </div>
                                      <button type="button" class="btn btn-sm btn-danger remove-image" 
                                              style="position: absolute; top: -8px; right: -8px; border-radius: 50%; width: 24px; height: 24px; font-size: 14px; padding: 0; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                        &times;
                                      </button>
                                    </div>
                                  @endforeach
                                </div>
                                @endif
                        
                                {{-- Input baru untuk upload gambar tambahan --}}
                                <div class="input-group mb-2">
                                    <input type="file" name="file_path[]" class="form-control" placeholder="Item Image">
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

    // Tombol + Add Image
    document.getElementById('add-image').addEventListener('click', () => {
      let wrapper = document.createElement('div');
      wrapper.classList.add('input-group', 'mb-2');
      wrapper.innerHTML = `
        <input type="file" name="file_path[]" class="form-control" placeholder="Item Image" required>
        <div class="input-group-append">
          <button class="btn btn-danger btn-sm remove-image" type="button">&times;</button>
        </div>`;
      document.getElementById('images-list').appendChild(wrapper);
    });

    // Event delegation untuk hapus gambar lama dan baru
    document.body.addEventListener('click', function(e) {
      if (e.target.classList.contains('remove-image')) {
        // Cari elemen wrapper terdekat, bisa untuk input-group (gambar baru) atau position-relative (gambar lama)
        const wrapper = e.target.closest('.input-group, .position-relative');
        if (wrapper) wrapper.remove();
      }
    });

  });
</script>
@endpush

@endsection
