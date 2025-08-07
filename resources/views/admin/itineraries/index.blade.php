@extends('app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Itinerary's Data</h1>
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
                <div class="card-header d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.itineraries.create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Add Itinerary
                    </a>
                </div>
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Subtitle</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($itineraries as $itinerary)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset('storage/' . $itinerary->image) }}" width="100">
                              <a href="{{ asset('storage/' . $itinerary->image) }}"></a>
                            </td>
                            <td>{{ $itinerary->subtitle }}</td>
                            <td>
                                <a href="{{ route('admin.itineraries.edit', $itinerary->id) }}" class="btn btn-primary"><i class="fas fa-pen"></i> Edit</a>
                                <form id="delete-form-{{ $itinerary->id }}" action="{{ route('admin.itineraries.destroy', $itinerary->id) }}" method="POST" style="display:inline;">
                                  @csrf
                                  @method('DELETE')
                                  <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $itinerary->id }})">Delete</button>
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
          text: "Data itinerary ini akan dihapus permanen!",
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

