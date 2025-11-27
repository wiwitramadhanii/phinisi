document.addEventListener("DOMContentLoaded", function () {
    const calendarDays = document.getElementById('calendarDays');
    const monthYear = document.getElementById('monthYear');
    const currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    function renderCalendar(month, year) {
        monthYear.innerText = `${getMonthName(month)} ${year}`;
        calendarDays.innerHTML = '';

        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        for (let i = 0; i < firstDay; i++) {
            const emptyCell = document.createElement('div');
            emptyCell.classList.add('emptyCell');
            calendarDays.appendChild(emptyCell);
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const dayCell = document.createElement('div');
            dayCell.classList.add('dayCell');
            dayCell.innerText = day;

            const formattedDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            const todayDate = getTodayDate();

            if (new Date(formattedDate) < new Date(todayDate)) {
                dayCell.classList.add('disabled');
                dayCell.style.cursor = 'not-allowed';
            } else {
                dayCell.addEventListener('click', function () {
                    document.querySelectorAll('.dayCell.selected').forEach(cell => cell.classList.remove('selected'));
                    dayCell.classList.add('selected');
                    updateBookingInfo(formattedDate);
                });
                
                if (formattedDate === todayDate) {
                    dayCell.classList.add('selected');
                    updateBookingInfo(formattedDate);
                }
            }

            calendarDays.appendChild(dayCell);
        }
    }

    function getMonthName(monthIndex) {
        const months = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        return months[monthIndex];
    }

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
                const bookings = data.bookings; 
                const eventList = document.getElementById('eventList');
                eventList.innerHTML = ''; 
    
                const fullDayBooked = bookings['4'] && bookings['4'].length > 0;                
                const halfDayGroupIds = ['1','2','3'];                                        
                const anyHalfDayBooked = halfDayGroupIds.some(id => bookings[id] && bookings[id].length > 0);
    
                events.forEach(event => {
                    const id = String(event.id);
                    const selfBooked = bookings[id] && bookings[id].length > 0;
    
                    let isBooked;
                    if (fullDayBooked) {
                        isBooked = true;
                    } else if (id === '4') {
                        isBooked = anyHalfDayBooked;
                    } else {
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
