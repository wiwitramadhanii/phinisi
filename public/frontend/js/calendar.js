document.addEventListener("DOMContentLoaded", function () {
    const calendarDays = document.getElementById('calendarDays');
    const monthYear = document.getElementById('monthYear');
    const currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    // Fungsi untuk menampilkan kalender
    function renderCalendar(month, year) {
        monthYear.innerText = `${getMonthName(month)} ${year}`;
        calendarDays.innerHTML = '';

        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        // Tambahkan cell kosong untuk hari sebelum hari pertama bulan berjalan
        for (let i = 0; i < firstDay; i++) {
            const emptyCell = document.createElement('div');
            emptyCell.classList.add('emptyCell');
            calendarDays.appendChild(emptyCell);
        }

        // Buat cell untuk setiap hari dalam bulan
        for (let day = 1; day <= daysInMonth; day++) {
            const dayCell = document.createElement('div');
            dayCell.classList.add('dayCell');
            dayCell.innerText = day;

            const formattedDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            const todayDate = getTodayDate();

            // Jika tanggal yang dibuat lebih kecil dari tanggal hari ini, nonaktifkan klik
            if (new Date(formattedDate) < new Date(todayDate)) {
                dayCell.classList.add('disabled');
                dayCell.style.cursor = 'not-allowed';
            } else {
                // Tambahkan event listener untuk klik pada dayCell
                dayCell.addEventListener('click', function () {
                    // Hapus kelas 'selected' dari cell yang sebelumnya dipilih
                    document.querySelectorAll('.dayCell.selected').forEach(cell => cell.classList.remove('selected'));
                    // Tambahkan kelas 'selected' ke cell yang di‑klik
                    dayCell.classList.add('selected');
                    // Update informasi booking sesuai tanggal yang dipilih
                    updateBookingInfo(formattedDate);
                });
                
                // Jika tanggal sama dengan hari ini, set default highlight dan update booking info
                if (formattedDate === todayDate) {
                    dayCell.classList.add('selected');
                    updateBookingInfo(formattedDate);
                }
            }

            calendarDays.appendChild(dayCell);
        }
    }

    // Mengambil nama bulan
    function getMonthName(monthIndex) {
        const months = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        return months[monthIndex];
    }

    // Menghasilkan tanggal hari ini dengan format YYYY-MM-DD
    function getTodayDate() {
        const today = new Date();
        return `${today.getFullYear()}-${String(today.getMonth() + 1).padStart(2, '0')}-${String(today.getDate()).padStart(2, '0')}`;
    }

    function updateBookingInfo(selectedDate) {
        fetch(`/booking-info?date=${selectedDate}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                const bookings = data.bookings; // e.g. { "1": [...], "2": [...], "3": [...], "4": [...] }
                const eventList = document.getElementById('eventList');
                eventList.innerHTML = ''; // Bersihkan daftar event sebelumnya
    
                // Cek status booking
                const fullDayBooked = bookings['4'] && bookings['4'].length > 0;                // Full Day Trip (ID 4)
                const morningGroupIds = ['1','2','3'];                                         // IDs paket pagi
                const anyMorningBooked = morningGroupIds.some(id => bookings[id] && bookings[id].length > 0);
    
                events.forEach(event => {
                    const id = String(event.id);
                    const selfBooked = bookings[id] && bookings[id].length > 0;
    
                    let isBooked;
                    if (fullDayBooked) {
                        // Jika Full Day Trip terpesan: semua paket full
                        isBooked = true;
                    } else if (id === '4') {
                        // Jika event adalah Full Day Trip & ada salah satu pagi terpesan: full
                        isBooked = anyMorningBooked;
                    } else {
                        // Paket pagi (1–3) hanya full jika sendiri terpesan
                        isBooked = selfBooked;
                    }
    
                    const li = document.createElement('li');
                    li.classList.add('event-info', 'mb-3', 'p-2', 'border', 'rounded');
                    li.innerHTML = `
                        <a href="/packages/${id}" class="paket-name h6 mb-2">${event.package_name}</a>
                        <div class="paket-time mb-1" style="font-size: 13px">Time: ${event.time}</div>
                        <div class="paket-route mb-2" style="font-size: 13px">Route: ${event.route}</div>
                        ${
                            isBooked
                            ? '<div class="bg-danger text-white p-2 rounded" style="font-size: 15px">This package is already booked for this date.</div>'
                            : '<div class="bg-success text-white p-2 rounded" style="font-size: 15px">This package is available for this date.</div>'
                        }
                    `;
                    eventList.appendChild(li);
                });
            })
            .catch(error => console.error('Error fetching booking info:', error));
    }
    

    // Navigasi ke bulan sebelumnya
    document.getElementById('prevMonth').addEventListener('click', function () {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        renderCalendar(currentMonth, currentYear);
    });

    // Navigasi ke bulan berikutnya
    document.getElementById('nextMonth').addEventListener('click', function () {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        renderCalendar(currentMonth, currentYear);
    });

    // Render kalender untuk bulan dan tahun saat ini
    renderCalendar(currentMonth, currentYear);
});
