@extends('layout')

@section('content')

<div class="destination_banner_wrap overlay">
    <div class="destination_text text-center">
    </div>
</div>

<div class="package_details_info">
    <div class="row">
        <div class="col-12">
            <div class="info-container">
                <div class="header-container">
                    <h2>{{ $package->package_name }}</h2>
                    <div class="event-type">Private Trip</div>
                </div>
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i> {{ $package->route }}
                </div>
                <div class="info-item">
                    <i class="far fa-clock"></i> {{ $package->time }}
                </div>
                <div class="info-item">
                    <i class="fas fa-users"></i> 10 - 50 Pax
                </div>
            </div>
            <div class="package-include-exclude">
                <div class="package-include">
                    <div class="include-title">Include</div>
                    <div class="include-list">
                        <div class="row">
                            @php
                                $chunks = collect($package->include)->chunk(ceil(count($package->include) / 2));
                            @endphp
                            <div class="col-6">
                                @foreach ($chunks[0] as $item)
                                <div><i class="fas fa-check-circle"></i> {{ $item }}</div>
                                @endforeach
                            </div>
                            <div class="col-6">
                                @foreach($chunks[1] as $item)
                                <div><i class="fas fa-check-circle"></i> {{ $item }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="exclude-list">
                        <div class="exclude-title">Exclude</div>
                        <div class="exclude-list">
                            <div><i class="fas fa-times-circle"></i> Add. Destination</div>
                            <div><i class="fas fa-times-circle"></i> Add. Meals</div>
                            <div><i class="fas fa-times-circle"></i> Add. Decoration</div>
                            <div><i class="fas fa-times-circle"></i> Tipping Crew</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="rundown-container">
                <h2>Rundown Activity</h2>
                
                <div class="rundown-details">
                    <div class="itinerary-time">
                        <span class="time">5.00-5.20 pm</span>
                    </div>
                    <div class="itinerary-details">
                        <h3>Welcome Greeting</h3>
                    </div>
                </div>
                
                <div class="rundown-details">
                    <div class="itinerary-time">
                        <span class="time">5.20-6.00 pm</span>
                    </div>
                    <div class="itinerary-details">
                        <h3>Education Phinisi & Sunset Time with Hakata Accoustic</h3>
                    </div>
                </div>

                <div class="rundown-details">
                    <div class="itinerary-time">
                        <span class="time">6.00-6.30 pm</span>
                    </div>
                    <div class="itinerary-details">
                        <h3>Maghrib Time</h3>
                    </div>
                </div>

                <div class="rundown-details">
                    <div class="itinerary-time">
                        <span class="time">6.30-7.00 pm</span>
                    </div>
                    <div class="itinerary-details">
                        <h3>Dinner Time</h3>
                    </div>
                </div>

                <div class="rundown-details">
                    <div class="itinerary-time">
                        <span class="time">7.00-7.40 pm</span>
                    </div>
                    <div class="itinerary-details">
                        <h3>Fireworks Celebrate & Dancing</h3>
                    </div>
                </div>

                <div class="rundown-details">
                    <div class="itinerary-time">
                        <span class="time">7.40-8.00 pm</span>
                    </div>
                    <div class="itinerary-details">
                        <h3>Sailing Back to Losari</h3>
                    </div>
                </div>
            </div>

            <div class="booking-container">
                <div class="booking-details">
                    <div class="header-booking">
                        <div class="header-title">Price List</div>
                    </div>
                    <form action="{{ route('bookings.billing.create', ['package_id' => $package->id]) }}" method="GET" id="bookingForm">
                        <div class="body-booking">
                            <div class="body-top-booking">
                                <div class="body-title">Tiket</div>
                                <div class="pax-controls" style="display: flex; align-items: center;">
                                    <select name="pax_category_id" id="pax-categories" style="margin-right: 10px;" required onchange="updatePrice()">
                                        <option value="">Choose Pax</option>
                                        @foreach ($paxCategories as $category)
                                            <option
                                                value="{{ $category->id }}" 
                                                data-price="{{ $category->price_per_pax }}" 
                                                data-pax-range="{{ $category->pax_range }}">
                                                {{ $category->pax_range }} pax (Rp {{ number_format($category->price_per_pax, 0, ',', '.') }}/pax)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="body-info-booking">
                                <div class="price" id="priceDisplay">Total Price: Rp 0</div>
                            </div>
                            <div class="body-bottom-booking">
                                <div class="date-available" style="display: flex; align-items: center;">
                                    <input type="date" name="selected_date" id="selected_date" onchange="checkDateAvailability()">
                                    <span id="availabilityMessage" style="margin-left: 10px;"></span>
                                </div>
                                
                                <div class="booking">
                                    <button type="submit" id="submitButton" onclick="return validateForm()">Book Now</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function updatePrice() {
        const selectElement = document.getElementById("pax-categories");
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const pricePerPax = selectedOption.getAttribute("data-price");
        const paxRange = selectedOption.getAttribute("data-pax-range");

        let paxCount = 1; // Default jika tidak ada kategori dipilih
        if (paxRange) {
            const [minPax] = paxRange.split('-').map(Number);
            paxCount = minPax; // Gunakan batas bawah dari rentang pax
        }

        if (pricePerPax) {
            const totalPrice = parseInt(pricePerPax) * paxCount;
            document.getElementById("priceDisplay").innerText = `Total Price: Rp ${totalPrice.toLocaleString('id-ID')}`;
        } else {
            document.getElementById("priceDisplay").innerText = "Total Price: Rp 0";
        }
    }
</script>
<script>
    function validateForm() {
        var paxCategory = document.getElementById("pax-categories").value;
        var selectedDate = document.getElementById("selected_date").value;

        if (paxCategory == "" || selectedDate == "") {
            alert("Please select both Pax category and Date before booking.");
            return false;
        }

        // Pengecekan apakah tanggal full booked
        const fullBookedDates = getFullBookedDatesSync(); // Fungsi sinkron
        if (fullBookedDates.includes(selectedDate)) {
            alert("The selected date is fully booked. Please choose another date.");
            return false;
        }

        return true;
    }

    // Fungsi sinkron untuk mendapatkan tanggal-tanggal full booked
    function getFullBookedDatesSync() {
        // Gunakan request sinkron untuk mendapatkan data
        var fullBookedDates = [];
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "/api/full-booked-dates", false); // false untuk sinkron
        xhr.onload = function () {
            if (xhr.status === 200) {
                fullBookedDates = JSON.parse(xhr.responseText);
            }
        };
        xhr.send();
        return fullBookedDates;
    }
</script>
<script>
    // Fungsi untuk memeriksa ketersediaan tanggal
    async function checkDateAvailability() {
        const selectedDate = document.getElementById('selected_date').value;
        const availabilityMessage = document.getElementById('availabilityMessage');
        const packageId = {{ $package->id }};  // Mengambil package_id saat ini dari URL
    
        if (!selectedDate) {
            availabilityMessage.textContent = 'Please select a date.';
            availabilityMessage.style.color = 'gray';
            return;
        }
    
        // Memanggil API untuk memeriksa ketersediaan tanggal
        const response = await fetch(`/api/check-availability?date=${selectedDate}&package_id=${packageId}`);
        const data = await response.json();
    
        // Cek apakah paket yang dipilih sudah dipesan
        if (data.unavailablePackages.includes(packageId)) {
            // Jika paket yang dipilih sudah dipesan, tampilkan pesan
            availabilityMessage.textContent = "Fully booked. Please choose another date.";
            availabilityMessage.style.color = 'red';
            document.getElementById('submitButton').disabled = true;  // Nonaktifkan tombol pemesanan
        } else {
            // Memeriksa apakah ada pemesanan Full Day Kodingareng di tanggal yang sama
            if (data.unavailablePackages.includes(3) && (packageId === 1 || packageId === 2)) {
                // Jika Full Day Kodingareng sudah dipesan, Golden Hours Cruise atau Morning Samalona tidak bisa dipesan
                availabilityMessage.textContent = "Fully booked. Please choose another date.";
                availabilityMessage.style.color = 'red';
                document.getElementById('submitButton').disabled = true;  // Nonaktifkan tombol pemesanan
            }
            // Memeriksa apakah ada pemesanan Golden Hours Cruise di tanggal yang sama
            else if (data.unavailablePackages.includes(1) && packageId === 2) {
                // Jika sudah ada pemesanan Golden Hours Cruise, Morning Samalona tetap bisa dipesan
                availabilityMessage.textContent = "The selected date is available.";
                availabilityMessage.style.color = 'green';
                document.getElementById('submitButton').disabled = false;  // Aktifkan tombol pemesanan
            }
            // Memeriksa apakah ada pemesanan Golden Hours Cruise atau Morning Samalona di tanggal yang sama
            else if ((data.unavailablePackages.includes(1) || data.unavailablePackages.includes(2)) && packageId === 3) {
                // Jika sudah ada pemesanan Golden Hours Cruise atau Morning Samalona, Full Day Kodingareng tidak bisa dipesan
                availabilityMessage.textContent = "Fully booked. Please choose another date."
                availabilityMessage.style.color = 'red';
                document.getElementById('submitButton').disabled = true;  // Nonaktifkan tombol pemesanan
            } else {
                // Jika tidak ada pemesanan atau paket yang bisa dipesan
                availabilityMessage.textContent = "The selected date is available.";
                availabilityMessage.style.color = 'green';
                document.getElementById('submitButton').disabled = false;  // Aktifkan tombol pemesanan
            }
        }
    }
</script>

@endsection