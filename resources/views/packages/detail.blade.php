@extends('app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-3 align-items-center">
          <div class="col-md-8">
            <h1 class="m-0 text">{{ $package->package_name }}</h1>
          </div>
          <div class="col-md-4">
            <ol class="breadcrumb float-md-right bg-white p-2 rounded shadow-sm">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('packages.index') }}">Packages</a></li>
              <li class="breadcrumb-item active">Detail</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm">
                <div class="card-body">

                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/' . $package->image) }}" 
                             alt="{{ $package->package_name }}" 
                             class="img-fluid rounded shadow-sm" 
                             style="max-height: 350px; object-fit: cover;">
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p><strong>⏰ Time:</strong> {{ $package->time }}</p>
                            <p><strong>🛣️ Route:</strong> {{ $package->route }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>👥 Pax:</strong> {{ $package->pax }}</p>
                            <p><strong>💰 Price:</strong> Rp {{ number_format($package->min_price, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="card h-100 border-primary">
                                <div class="card-header bg-primary text-white">
                                    <strong>✅ Include</strong>
                                </div>
                                <ul class="list-group list-group-flush">
                                    @forelse ($package->include ?? [] as $include)
                                        <li class="list-group-item">{{ $include }}</li>
                                    @empty
                                        <li class="list-group-item text-muted">No data</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card h-100 border-danger">
                                <div class="card-header bg-danger text-white">
                                    <strong>❌ Exclude</strong>
                                </div>
                                <ul class="list-group list-group-flush">
                                    @forelse ($package->exclude ?? [] as $exclude)
                                        <li class="list-group-item">{{ $exclude }}</li>
                                    @empty
                                        <li class="list-group-item text-muted">No data</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card h-100 border-info">
                                <div class="card-header bg-info text-white">
                                    <strong>📋 Rundown</strong>
                                </div>
                                <ul class="list-group list-group-flush">
                                    @forelse ($package->rundown ?? [] as $item)
                                        <li class="list-group-item">
                                            <strong>{{ $item['time'] ?? '-' }}</strong> — {{ $item['activity'] ?? '-' }}
                                        </li>
                                    @empty
                                        <li class="list-group-item text-muted">No data</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('packages.index') }}" class="btn btn-outline-secondary">
                            ← Back to Packages
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
