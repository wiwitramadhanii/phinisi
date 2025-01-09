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

        // Add empty cells for days before the first day of the month
        for (let i = 0; i < firstDay; i++) {
            const emptyCell = document.createElement('div');
            emptyCell.classList.add('emptyCell');
            calendarDays.appendChild(emptyCell);
        }

        // Populate the days in the month
        for (let day = 1; day <= daysInMonth; day++) {
            const dayCell = document.createElement('div');
            dayCell.classList.add('dayCell');
            dayCell.innerText = day;

            const formattedDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            fetchAvailability(dayCell, formattedDate);

            calendarDays.appendChild(dayCell);
        }
    }

    function fetchAvailability(dayCell, date) {
        fetch(`/api/check-availability?date=${date}`)
            .then(response => response.json())
            .then(data => {
                if (data.is_full_booked) {
                    dayCell.classList.add('full-booked');
                    dayCell.title = 'Full Booked';
                } else if (data.is_available) {
                    dayCell.classList.add('available');
                    dayCell.title = `Available: ${data.package_name}`;
                } else {
                    dayCell.classList.add('not-available');
                    dayCell.title = 'No Packages Available';
                }

                // Highlight today's date
                if (date === getTodayDate()) {
                    dayCell.classList.add('today');
                }
            })
            .catch(error => {
                console.error('Error fetching availability:', error);
            });
    }

    function getMonthName(monthIndex) {
        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        return months[monthIndex];
    }

    function getTodayDate() {
        const today = new Date();
        return `${today.getFullYear()}-${String(today.getMonth() + 1).padStart(2, '0')}-${String(today.getDate()).padStart(2, '0')}`;
    }

    document.getElementById('prevMonth').addEventListener('click', function () {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        renderCalendar(currentMonth, currentYear);
    });

    document.getElementById('nextMonth').addEventListener('click', function () {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        renderCalendar(currentMonth, currentYear);
    });

    // Render calendar for the current month and year
    renderCalendar(currentMonth, currentYear);
});
