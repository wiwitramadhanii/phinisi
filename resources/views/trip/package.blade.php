@extends('layout')

@section('content')

{{-- <form id="searchForm" action="{{ route('home.search') }}" method="GET">
    <div class="date-picker-container">
        <input type="text" id="datepicker" name="date" placeholder="Choose Date" required />
        <button id="searchButton" type="submit">Search</button>
    </div>
</form>

<div id="results"></div> --}}

<div class="package_event_area">
    <div class="container">
        <h1>Find Your Favorite Package</h1>
        <div class="row" id="packageList">
            @foreach ($packages as $package)
            <div class="col-6 package-item">
                <div class="package-container">
                    <div class="package-content">
                        <div class="package-image">
                            <a href="{{ route('packages.show', $package->id, ['date' => request('date')]) }}">
                                <img src="{{ asset('storage/' . $package->image) }}" alt="">
                            </a>
                        </div>
                        <div class="package-data-wrapper">
                            <a href="{{ route('packages.show', $package->id, ['date' => request('date')]) }}">
                                <div class="package-data">
                                    <div class="package-title">{{ $package->package_name }}</div>
                                </div>
                                <div class="package-bottom-data">
                                    <div class="package-price-wrapper">
                                        <div class="package-start-from">Start From</div>
                                        <div class="package-price">Rp {{ $package->min_price }}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection