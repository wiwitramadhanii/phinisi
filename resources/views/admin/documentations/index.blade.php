@extends('app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Documentation's Data</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                <a href="{{ route('admin.documentations.create') }}" class="btn btn-success">
                  <i class="fas fa-plus"></i> Add File
                </a>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Package</th>
                      <th>Image</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($documentations as $documentation)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $documentation->package->package_name ?? $documentation->package_id }}</td>
                        <td>
                          <ul class="list-unstyled d-flex flex-wrap gap-2">
                            @foreach($documentation->file_path ?? [] as $path)
                              <li>
                                <img src="{{ asset('storage/' . $path) }}" width="100" class="img-thumbnail" alt="Documentation {{ $documentation->id }}">
                                  <a href="{{ asset('storage/' . $path) }}"></a>
                              </li>
                            @endforeach
                          </ul>
                        </td>                        
                        <td>
                          <a href="{{ route('admin.documentations.edit', $documentation->id) }}"
                             class="btn btn-sm btn-primary">
                            <i class="fas fa-pen"></i>
                          </a>
                          <form id="delete-form-{{ $documentation->id }}" action="{{ route('admin.documentations.destroy', $documentation->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $documentation->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                          </form>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="4" class="text-center">Belum ada dokumentasi</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function confirmDelete(id) {
      Swal.fire({
          title: 'Apakah kamu yakin?',
          text: "Data dokumentasi ini akan dihapus permanen!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya, hapus!',
          cancelButtonText: 'Batal'
      }).then((result) => {
          if (result.isConfirmed) {
              document.getElementById('delete-form-' + id).submit();
          }
      });
  }
</script>
@endsection
