@extends('layout')

@section('content')
    <div class="payment-container">
        <h3>Detail Pemesanan</h3>

        <div class="booking-details">
            <p><strong>Nama:</strong> {{ $booking->name }}</p>
            <p><strong>Email:</strong> {{ $booking->email }}</p>
            <p><strong>Phone Number:</strong> {{ $booking->phone }}</p>
            <p><strong>Package Name:</strong> {{ $booking->package->package_name }}</p>
            <p><strong>Time:</strong> {{ $booking->package->time }}</p>
            <p><strong>Date:</strong> {{ $booking->selected_date }}</p>
            <p><strong>Pax Category:</strong> {{ $booking->pax_category }}</p>
            <p><strong>Number of Pax:</strong> {{ $booking->num_pax }}</p>
            <p><strong>Total Price:</strong> Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
        </div>

        <hr>

        <div class="payment-info">
            <h4>Payment Information</h4>
            <p><strong>Account Number:</strong> 1520018649828 (Bank Mandiri)</p>
            <p><strong>Amount to be paid:</strong> Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>

            <p><strong>Payment Confirmation:</strong> You can confirm the payment via WhatsApp:</p>
            <a href="https://wa.me/6282345600773?text=Saya%20telah%20melakukan%20pembayaran%20untuk%20pemesanan%20paket%20trip%20{{ urlencode($booking->package->package_name) }}%20tanggal%20{{ urlencode($booking->selected_date) }}.%20Jumlah%20pax%20:{{ $booking->num_pax }}.%20Total%20harga%20Rp%20{{ number_format($booking->total_price, 0, ',', '.') }}" class="btn btn-success" target="_blank">
                Confirm Payment via WhatsApp
            </a>
            <div class="home-button mt-1">
                <a href="{{ url('/') }}" class="btn btn-primary">
                    Back to Home
                </a>
            </div>
        </div>

        <hr>
    </div>

    <style>
        .payment-container {
            padding: 30px;
        }

        .booking-details, .payment-info {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
        }

        .payment-info h4 {
            margin-bottom: 10px;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
    </style>
@endsection
