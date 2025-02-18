@extends('app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Package Data</h1>
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
                        <a href="{{ route('packages.create') }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> Add Package
                        </a>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Package Name</th>
                                    <th>Banner</th>
                                    <th>Time</th>
                                    <th>Route</th>
                                    <th>Price</th>
                                    <th>Include</th>
                                    <th>Exclude</th>
                                    <th>Rundown</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($packages as $package)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $package->package_name }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $package->banner) }}" width="100">
                                    </td>
                                    <td>
                                        <img src="{{ asset('storage/' . $package->image) }}" width="100">
                                    </td>
                                    <td>{{ $package->time }}</td>
                                    <td>{{ $package->route }}</td>
                                    <td>Rp {{ number_format($package->min_price, 0, ',', '.') }}</td>
                                    <td>
                                        <ul>
                                            @foreach(is_string($package->include) ? json_decode($package->include) : $package->include as $include)
                                                <li>{{ $include }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach(is_string($package->exclude) ? json_decode($package->exclude) : $package->exclude as $exclude)
                                                <li>{{ $exclude }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach(is_string($package->rundown) ? json_decode($package->rundown, true) : $package->rundown as $rundown)
                                                <li><strong>{{ $rundown['time'] }}</strong> - {{ $rundown['activity'] }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <a href="{{ route('packages.edit', $package->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-pen"></i> Edit
                                        </a>
                                        <form action="{{ route('packages.destroy', $package->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
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
    </div>
</section>
<!-- /.content -->

</div>

@endsection

