<div class="schedule_area">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="section_title text-center mb_60">
                <h3 class="mb-1">Our Schedule</h3>
                <p>
                    Don't delay your holiday! From island hopping to golden sunsets, choose your favourite trip and set sail with us.
                </p>
            </div>
        </div>
      </div>
      <div class="row p-3 justify-content-center">
          <div id="calendar">
              <div class="calendar-header">
                <button id="prevMonth">&lt;</button>
                <div id="monthYear"></div>
                <button id="nextMonth">&gt;</button>
              </div>
              <div class="calendar-body">
                  <div id="daysOfWeek">
                      <div class="day">Sun</div>
                      <div class="day">Mon</div>
                      <div class="day">Tue</div>
                      <div class="day">Wed</div>
                      <div class="day">Thu</div>
                      <div class="day">Fri</div>
                      <div class="day">Sat</div>
                  </div>
                  <div id="calendarDays"></div>
              </div>
          </div>
          <div id="calendarEvent">
              <div class="calendar-content">
                  <div class="container text-white">
                      <!-- Header tanggal event akan di-update secara dinamis -->
                      <h3 id="eventDate" class="mb-3">Packages</h3>
                      <ul id="eventList" class="list-unstyled">
                          <!-- Data event awal akan di-render via API dari JS -->
                          <li class="event-info">No events are available.</li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
    </div>  
</div>

<script>
    var events = @json($events);
</script>