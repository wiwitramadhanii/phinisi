@extends('app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Package</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('packages.index') }}">Back</a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Package Form</h3>
              </div>
              <form action="{{ route('packages.update', $package->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Package Name</label>
                        <input type="text" name="package_name" class="form-control" value="{{ old('package_name', $package->package_name) }}" required>
                      </div>
                      <div class="form-group">
                        <label>Time</label>
                        <input type="text" name="time" class="form-control" value="{{ old('time', $package->time) }}" required>
                      </div>
                      <div class="form-group">
                        <label>Pax</label>
                        <input type="text" name="pax" class="form-control" value="{{ old('pax', $package->pax) }}" required>
                      </div>
                    </div>
                
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label>Route</label>
                        <input type="text" name="route" class="form-control" value="{{ old('route', $package->route) }}" required>
                      </div>
                      <div class="form-group">
                        <label>Price</label>
                        <input type="number" name="min_price" class="form-control" value="{{ old('min_price', $package->min_price) }}" required>
                      </div>
                    </div>
                  </div>
              
                  <div class="form-group">
                    <label>Include Items</label>
                    <div id="include-list">
                      @foreach(old('include', $package->include ?? []) as $item)
                          <div class="input-group mb-2">
                              <input type="text" name="include[]" class="form-control" placeholder="Item included" value="{{ $item }}" required>
                              <div class="input-group-append">
                                  <button class="btn btn-danger remove-include" type="button">&times;</button>
                              </div>
                          </div>
                      @endforeach
                    </div>
                    <button id="add-include" class="btn btn-secondary btn-sm" type="button">+ Add Include</button>
                  </div>
                
                  <div class="form-group">
                    <label>Exclude Items</label>
                    <div id="exclude-list">
                      @foreach(old('exclude', $package->exclude ?? []) as $item)
                          <div class="input-group mb-2">
                              <input type="text" name="exclude[]" class="form-control" placeholder="Item Exclude" value="{{ $item }}" required>
                              <div class="input-group-append">
                                  <button class="btn btn-danger remove-exclude" type="button">&times;</button>
                              </div>
                          </div>
                      @endforeach
                    </div>
                    <button id="add-exclude" class="btn btn-secondary btn-sm" type="button">+ Add Exclude</button>
                  </div>
                
                  <div class="form-group">
                    <label>Rundown Schedule</label>
                    <div id="rundown-list">
                        @php
                            $rundownData = old('rundown', $package->rundown ?? []);
                        @endphp
                
                        @forelse($rundownData as $index => $item)
                            <div class="form-row mb-2">
                                <div class="col-3">
                                    <input type="time" name="rundown[{{ $index }}][time]" class="form-control"
                                           value="{{ $item['time'] ?? '' }}" required>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="rundown[{{ $index }}][activity]" class="form-control"
                                           placeholder="Activity" value="{{ $item['activity'] ?? '' }}" required>
                                </div>
                                <div class="col-1">
                                    <button class="btn btn-danger remove-rundown" type="button">&times;</button>
                                </div>
                            </div>
                        @empty
                            <div class="form-row mb-2">
                                <div class="col-3">
                                    <input type="time" name="rundown[0][time]" class="form-control" required>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="rundown[0][activity]" class="form-control" placeholder="Activity" required>
                                </div>
                                <div class="col-1">
                                    <button class="btn btn-danger remove-rundown" type="button">&times;</button>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <button id="add-rundown" class="btn btn-secondary btn-sm" type="button">+ Add Rundown</button>
                  </div>
                </div>
                
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>

{{-- JavaScript Dinamis --}}
@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Include
    document.getElementById('add-include').addEventListener('click', () => {
      let wrapper = document.createElement('div');
      wrapper.classList.add('input-group', 'mb-2');
      wrapper.innerHTML = `
        <input type="text" name="include[]" class="form-control" placeholder="Item included" required>
        <div class="input-group-append">
          <button class="btn btn-danger remove-include" type="button">&times;</button>
        </div>`;
      document.getElementById('include-list').appendChild(wrapper);
    });
    document.body.addEventListener('click', e => {
      if (e.target.classList.contains('remove-include')) e.target.closest('.input-group').remove();
    });

    // Exclude
    document.getElementById('add-exclude').addEventListener('click', () => {
      let wrapper = document.createElement('div');
      wrapper.classList.add('input-group', 'mb-2');
      wrapper.innerHTML = `
        <input type="text" name="exclude[]" class="form-control" placeholder="Item excluded" required>
        <div class="input-group-append">
          <button class="btn btn-danger remove-exclude" type="button">&times;</button>
        </div>`;
      document.getElementById('exclude-list').appendChild(wrapper);
    });
    document.body.addEventListener('click', e => {
      if (e.target.classList.contains('remove-exclude')) e.target.closest('.input-group').remove();
    });

    // Rundown
    let rundownIndex = 1;
    document.getElementById('add-rundown').addEventListener('click', () => {
      let row = document.createElement('div');
      row.classList.add('form-row', 'mb-2');
      row.innerHTML = `
        <div class="col-3">
          <input type="time" name="rundown[${rundownIndex}][time]" class="form-control" required>
        </div>
        <div class="col-8">
          <input type="text" name="rundown[${rundownIndex}][activity]" class="form-control" placeholder="Activity" required>
        </div>
        <div class="col-1">
          <button class="btn btn-danger remove-rundown" type="button">&times;</button>
        </div>`;
      rundownIndex++;
      document.getElementById('rundown-list').appendChild(row);
    });
    document.body.addEventListener('click', e => {
      if (e.target.classList.contains('remove-rundown')) e.target.closest('.form-row').remove();
    });
  });
</script>
@endpush

@endsection