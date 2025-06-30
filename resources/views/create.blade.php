@extends('layouts.app')

@section('title')
    Create Todo
@endsection

@section('content')
<section class="min-vh-100 d-flex align-items-center" style="background: linear-gradient(to bottom right, #0d47a1, #1976d2);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-7"> <!-- ✅ Lebar dibatasi -->

                <div class="card shadow-lg border-0 rounded-4" style="background-color: #eef4ff;">
                    <div class="card-body p-4">
                        <h3 class="text-center text-primary fw-bold mb-4">
                            <i class="fas fa-plus-circle me-2"></i> Tambah Todo Baru
                        </h3>

                        <!-- ✅ FORM -->
                        <form action="/store-data" method="post">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="name" class="fw-semibold">Nama Todo</label>
                                <input type="text" class="form-control shadow-sm" name="name" id="todo-name" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="description" class="fw-semibold">Deskripsi</label>
                                <textarea class="form-control shadow-sm" name="description" id="todo-description" rows="3" required></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="deadline" class="fw-semibold">🗓 Deadline</label>
                                <input type="date" name="deadline" id="deadline" class="form-control shadow-sm" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="location" class="fw-semibold">📍 Lokasi (opsional)</label>
                                <input type="text" name="location_name" id="location_name" class="form-control shadow-sm" placeholder="Misal: Kampus A, Rumah, Kantor">
                                <input type="hidden" name="latitude" id="latitude">
                                <input type="hidden" name="longitude" id="longitude">
                                <button type="button" class="btn btn-sm btn-outline-secondary mt-2" onclick="getLocation()">Gunakan Lokasi Sekarang</button>
                            </div>

                            <div class="form-group mb-4">
                                <label for="status" class="fw-semibold">Status</label>
                                <select class="form-select shadow-sm" name="status" required>
                                    <option value="Todo">Todo</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Done">Done</option>
                                </select>
                            </div>

                            <div class="text-end">
                                <input type="submit" class="btn btn-primary shadow-sm px-4" value="Submit">
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- ✅ Script Geolokasi -->
<script>
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                document.getElementById('latitude').value = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;
                alert("Lokasi berhasil diambil ✅");
            },
            function(error) {
                alert("Gagal mengambil lokasi: " + error.message);
            }
        );
    } else {
        alert("Browser tidak mendukung Geolocation.");
    }
}
</script>
@endsection