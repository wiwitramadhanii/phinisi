@extends('app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pax Category's Data</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Pax Categories</li>
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
                <div class="card-header d-flex justify-content-between align-items-center">
                    <a href="{{ route('paxCategories.create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Add Pax Category
                    </a>
                </div>
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Package</th>
                        <th>Pax Range</th>
                        <th>Price Per Pax</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($paxCategories as $paxCategory)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $paxCategory->package->package_name }}</td>
                            <td>{{ $paxCategory->pax_range }}</td>
                            <td>{{ number_format($paxCategory->price_per_pax) }}</td>
                            <td>
                                <a href="{{ route('paxCategories.edit', $paxCategory->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i> Edit</a>
                                <form id="delete-form-{{ $paxCategory->id }}" action="{{ route('paxCategories.destroy', $paxCategory->id) }}" method="POST" style="display:inline;">
                                  @csrf
                                  @method('DELETE')
                                  <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $paxCategory->id }})">
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
    </section>
    <!-- /.content -->
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function confirmDelete(id) {
      Swal.fire({
          title: 'Apakah kamu yakin?',
          text: "Data Pax Category ini akan dihapus permanen!",
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
