@extends('layout')

@section('content')
    <div class="billing_area">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="billing-form">
                        <h3>Form Data Diri</h3>
                        <form action="{{ route('bookings.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="package_id" value="{{ $package->id }}">
                            <input type="hidden" name="selected_date" value="{{ request('selected_date') }}">
                            <input type="hidden" name="pax_category_id" id="pax_category_id"
                                value="{{ old('pax_category_id', $paxCategory->id) }}">
                            <input type="hidden" name="total_price" id="total_price" value="0">
                            <input type="hidden" name="pax_category" value="{{ $paxCategory->pax_range }}">

                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="number" name="phone" id="phone" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="pax">Number of Pax</label>
                                <input type="number" name="num_pax" id="pax" class="form-control"
                                    min="{{ $minPax }}" max="{{ $maxPax }}" required>
                            </div>

                            <div class="form-group">
                                <label>Total Price:</label>
                                <p id="display_total_price">Rp 0</p>
                            </div>

                            <button type="submit" class="btn btn-primary">Checkout</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="package-details">
                        <h2>{{ $package->package_name }}</h2>
                        <p><strong>Route:</strong> {{ $package->route }}</p>
                        <p><strong>Time:</strong> {{ $package->time }}</p>
                        <p><strong>Date:</strong> {{ request('selected_date') }}</p>
                        <p><strong>Pax Category:</strong> <span id="selected_pax_category">{{ $paxCategory->pax_range }}
                                pax (Rp {{ number_format($paxCategory->price_per_pax, 0, ',', '.') }}/pax)</span></p>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .billing_area {
                padding: 40px;

            }

            .package-details {
                border: 1px solid #ccc;
                padding: 15px;
                margin-bottom: 20px;
                border-radius: 10px
            }

            .billing-form {
                border: 1px solid #ccc;
                padding: 15px;
                border-radius: 10px
            }

            .form-group {
                margin-bottom: 15px;
            }

            .btn-primary {
                background-color: #007bff;
                border-color: #007bff;
                color: white;
                padding: 10px 20px;
                border-radius: 5px;
            }

            .btn-primary:hover {
                background-color: #0056b3;
                border-color: #0056b3;
            }
        </style>

        <script>
            document.getElementById('pax').addEventListener('input', function() {
                // Harga per pax dari server-side
                const pricePerPax = {{ $pricePerPax }};

                // Jumlah pax yang dipilih oleh user
                const numPax = parseInt(this.value) || 0;

                // Kalkulasi total harga
                const totalPrice = numPax * pricePerPax;

                // Menampilkan total harga di elemen dengan id 'display_total_price'
                document.getElementById('display_total_price').textContent =
                    `Rp ${new Intl.NumberFormat('id-ID').format(totalPrice)}`;
                document.getElementById('total_price').value = totalPrice;
            });
        </script>
    </div>
@endsection
