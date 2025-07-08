@extends('app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Documentation Data</h1>
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
                        <td>{{ $documentation->package->name ?? $documentation->package_id }}</td>
                        <td>
                          <img src="{{ asset('storage/' . $documentation->file_path) }}"
                               width="100"
                               class="img-thumbnail"
                               alt="Documentation {{ $documentation->id }}">
                        </td>
                        <td>
                          <a href="{{ route('admin.documentations.edit', $documentation->id) }}"
                             class="btn btn-sm btn-primary">
                            <i class="fas fa-pen"></i>
                          </a>
                          <form action="{{ route('admin.documentations.destroy', $documentation->id) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Hapus gambar ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
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

@endsection
