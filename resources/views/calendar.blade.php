@extends('layouts.app')

@section('content')
<section class="min-vh-100 py-5" style="background: linear-gradient(to bottom right, #0d47a1, #1976d2);">
  <div class="container">
    <div class="card border-0 shadow-sm" style="background-color: #eef4ff;">
      <div class="card-body">
        <h4 class="text-primary fw-bold mb-4">📅 Kalender Tugas</h4>
        <div id="calendar"></div>
      </div>
    </div>
  </div>
</section>

<!-- ✅ Modal Tambah Tugas -->
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="addTaskForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addTaskLabel">Tambah Tugas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="selectedDate" name="deadline">
          <div class="mb-3">
            <label for="taskName" class="form-label">Nama Tugas</label>
            <input type="text" class="form-control" id="taskName" name="name" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- ✅ Modal Daftar Tugas -->
<div class="modal fade" id="taskListModal" tabindex="-1" aria-labelledby="taskListLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="taskListLabel">Daftar Tugas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="taskListContent">
        <!-- Diisi lewat JavaScript -->
      </div>
    </div>
  </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
<style>
  body {
    font-family: 'Nunito', sans-serif;
  }

  #calendar {
    background-color: white;
    border-radius: 12px;
    padding: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
  }

  .fc-toolbar-title {
    color: #0d47a1;
    font-weight: 600;
  }

  .fc-button {
    background-color: #1976d2 !important;
    border: none !important;
  }

  .fc-button:hover {
    background-color: #145ea8 !important;
  }

  .fc-col-header-cell-cushion,
  .fc-daygrid-day-number {
    color: #0d47a1;
    font-weight: 500;
    text-decoration: none;
  }

  .fc-daygrid-day:hover {
    background-color: #e3f2fd;
    cursor: pointer;
  }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const calendarEl = document.getElementById('calendar');

  const calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    selectable: true,
    events: '/calendar/events',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: ''
    },

    dateClick: function(info) {
      fetch(`/calendar/events?date=${info.dateStr}`)
        .then(response => response.json())
        .then(data => {
          const modalContent = document.getElementById('taskListContent');
          if (data.length === 0) {
            modalContent.innerHTML = '<p>Tidak ada tugas untuk tanggal ini.</p>';
          } else {
            modalContent.innerHTML = data.map(task => `
              <div class="mb-3">
                <strong>${task.title}</strong><br>
                <small>${task.description || '-'}</small>
              </div>
            `).join('');
          }

          new bootstrap.Modal(document.getElementById('taskListModal')).show();

          document.getElementById('selectedDate').value = info.dateStr;
          document.getElementById('taskName').value = '';
        });
    }
  });

  calendar.render();

  document.getElementById('addTaskForm').addEventListener('submit', function(e) {
    e.preventDefault();
    fetch('/calendar/api-store', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        name: document.getElementById('taskName').value,
        deadline: document.getElementById('selectedDate').value
      })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        calendar.refetchEvents();
        bootstrap.Modal.getInstance(document.getElementById('addTaskModal')).hide();
      }
    });
  });
});
</script>
@endpush
