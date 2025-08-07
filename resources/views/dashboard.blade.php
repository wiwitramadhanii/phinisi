@extends('app')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
              <p>Total Revenue</p>
            </div>
            <div class="icon">
              <i class="fas fa-dollar-sign" style="font-size: 60px;"></i>
            </div>
            <a href="{{ route('packages.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ number_format($totalPackages, 0, ',', '.') }}</h3>
              <p>Total Package</p>
            </div>
            <div class="icon">
              <i class="fas fa-compass" style="font-size: 60px;"></i>
            </div>
            <a href="{{ route('packages.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ number_format($totalPaidCustomers, 0, ',', '.') }}</h3>
              <p>Total Customer (Paid)</p>
            </div>
            <div class="icon">
              <i class="fas fa-check-circle" style="font-size: 60px;"></i>
            </div>
            <a href="{{ route('admin.bookings.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ number_format($totalUnpaidCustomers, 0, ',', '.') }}</h3>

              <p>Total Customer (Unpaid)</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add" style="font-size: 60px;"></i>
            </div>
            <a href="{{ route('admin.bookings.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        {{-- col-lg-7 --}}
        <section class="col-12 connectedSortable">  
          <!-- Custom tabs (Charts with tabs)-->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-ship"></i>
                Revenue Per Package 
              </h3>
              <div class="card-tools">
                <form method="GET" action="{{ url()->current() }}" class="form-inline">
                  {{-- Filter Bulan --}}
                  <div class="input-group input-group-sm mr-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-info border-info">
                        <i class="far fa-calendar-alt text-white"></i>
                      </span>
                    </div>
                    <input
                      type="month"
                      name="filter_month"
                      class="form-control border-info"
                      value="{{ request('filter_month') }}"
                      title="Pilih Bulan"
                    >
                  </div>
              
                  {{-- Filter Tahun --}}
                  <div class="input-group input-group-sm mr-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-success border-success">
                        <i class="far fa-clock text-white"></i>
                      </span>
                    </div>
                    <select
                      name="filter_year"
                      class="form-control border-success"
                      title="Pilih Tahun"
                    >
                      <option value="">All Years</option>
                      @foreach(range(now()->year, now()->year - 5) as $yr)
                        <option
                          value="{{ $yr }}"
                          {{ request('filter_year') == $yr ? 'selected' : '' }}
                        >{{ $yr }}</option>
                      @endforeach
                    </select>
                  </div>
              
                  {{-- Tombol Submit --}}
                  <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fas fa-search"></i> Filter
                  </button>
                  {{-- Tombol Reset --}}
                  <a href="{{ url()->current() }}" class="btn btn-sm btn-danger">
                    <i class="fas fa-times-circle"></i> Reset
                  </a>
                </form>
              </div>
            </div><!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="max-height: 250px;">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>Package</th>
                    <th class="text-end">Revenue</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($revenueByPackage as $item)
                    <tr>
                      <td>{{ $item->package_name }}</td>
                      <td class="text-end">Rp {{ number_format($item->revenue,0,',','.') }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-calendar-alt"></i>
                Income
              </h3>
              <div class="card-tools">
                <form method="GET" action="{{ url()->current() }}" class="form-inline">
                  {{-- Filter Bulan --}}
                  <div class="input-group input-group-sm mr-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-info border-info">
                        <i class="far fa-calendar-alt text-white"></i>
                      </span>
                    </div>
                    <input
                      type="month"
                      name="filter_month"
                      class="form-control border-info"
                      value="{{ request('filter_month') }}"
                      title="Pilih Bulan"
                    >
                  </div>
              
                  {{-- Filter Tahun --}}
                  <div class="input-group input-group-sm mr-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-success border-success">
                        <i class="far fa-clock text-white"></i>
                      </span>
                    </div>
                    <select
                      name="filter_year"
                      class="form-control border-success"
                      title="Pilih Tahun"
                    >
                      <option value="">All Years</option>
                      @foreach(range(now()->year, now()->year - 5) as $yr)
                        <option
                          value="{{ $yr }}"
                          {{ request('filter_year') == $yr ? 'selected' : '' }}
                        >{{ $yr }}</option>
                      @endforeach
                    </select>
                  </div>
              
                  {{-- Tombol Submit --}}
                  <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fas fa-search"></i> Filter
                  </button>
                  {{-- Tombol Reset --}}
                  <a href="{{ url()->current() }}" class="btn btn-sm btn-danger">
                    <i class="fas fa-times-circle"></i> Reset
                  </a>
                </form>
              </div>
              
            </div><!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="max-height: 250px;">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Revenue</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($monthlyRevenueDetailed as $ym => $rev)
                    @php
                      [$year, $monthNum] = explode('-', $ym);
                      $monthName = \Carbon\Carbon::createFromDate($year, $monthNum, 1)
                                      ->translatedFormat('F');
                    @endphp
                    <tr>
                      <td>{{ $monthName }}</td>
                      <td>{{ $year }}</td>
                      <td>Rp {{ number_format($rev, 0, ',', '.') }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.card -->
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        {{-- <section class="col-lg-5 connectedSortable">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Revenue Analytics ({{ \Carbon\Carbon::now()->format('Y') }})
              </h3>
              <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  <li class="nav-item">
                    <a class="nav-link active" href="#area-chart" data-toggle="tab">Area</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#donut-chart" data-toggle="tab">Donut</a>
                  </li>
                </ul>
              </div>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content p-0">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="area-chart" style="position: relative; height: 320px;">
                  <canvas id="revenueAreaChart" height="320"></canvas>
                </div>
                <div class="chart tab-pane" id="donut-chart" style="position: relative; height: 320px;">
                  <canvas id="revenueDonutChart" height="320"></canvas>
                </div>
              </div>
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </section> --}}
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Ambil key "YYYY-MM" dari PHP
    const rawLabels = {!! json_encode(array_keys($monthlyRevenueDetailed)) !!};
    // Convert ke nama bulan Indonesia, misal "2025-01" → "Januari"
    const labels = rawLabels.map(ym => {
      const [year, month] = ym.split('-');
      return new Date(year, month - 1)
        .toLocaleString('id-ID', { month: 'long' });
    });
  
    const data = {!! json_encode(array_values($monthlyRevenueDetailed)) !!};
  
    // Area Chart
    new Chart(
      document.getElementById('revenueAreaChart').getContext('2d'),
      {
        type: 'line',
        data: { labels, datasets: [{ label: 'Revenue', data, fill: true, tension: 0.3 }] },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            y: {
              ticks: { callback: v => 'Rp ' + v.toLocaleString('id-ID') }
            }
          }
        }
      }
    );
  
    // Donut Chart
    new Chart(
      document.getElementById('revenueDonutChart').getContext('2d'),
      {
        type: 'doughnut',
        data: { labels, datasets: [{ data, backgroundColor: ['#4CAF50','#2196F3','#FF9800','#E91E63','#9C27B0','#3F51B5'] }] },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: { legend: { position: 'right' } }
        }
      }
    );
  });
</script>
@endsection